#!/bin/bash

TMPDIR=models.tmp
DELETED_AT=DeletedAt

function rename_method {
    file=$1
    relatedClass=$2
    field0=$3
    field1=$4
    newName=$5
    relType=$6
    if [[ "$relType" == "" ]]; then
        relType="[a-zA-Z]+"
    fi
    exp='s/(public function )[a-zA-Z_0-9]+(\(\) \{\n +return \$this->'"$relType"'\(\\App\\Models\\'"$relatedClass"'::class, '"'$field0', '$field1'\\);\n *\\}"')/\1'"$newName"'\2/g'
    echo "$file :: $exp"
    perl -i -p0e "$exp" "$file"
}

function remove_method {
    file=$1
    methodName=$2
    relatedClass=$3
    relDef0=$4
    relDef1=$5
    relDef2=$6
    if [[ "$relDef2" == "" ]]; then
        exp=' *public function '"$methodName"'\(\) \{\n *return \$this->[a-zA-Z0-9_]+\(\\App\\Models\\'"$relatedClass"'::class, '"'$relDef0', '$relDef1'"'\);\n *\}\n\n'
    else
        exp=' *public function '"$methodName"'\(\) \{\n *return \$this->[a-zA-Z0-9_]+\(\\App\\Models\\'"$relatedClass"'::class, '"'$relDef0', '$relDef1', '$relDef2'"'\);\n *\}\n\n'
    fi
    exp="s/$exp//g"
    echo "$file :: $exp"
    perl -i -p0e "$exp" "$file"
}

./workarounds/sqlsrv-sysname/apply.sh

if [[ -d $TMPDIR ]]; then
	rm -rf $TMPDIR
fi

mkdir $TMPDIR

./artisan models:generate -vvv -p $TMPDIR --namespace=App\\Models\\Base

rm $TMPDIR/Z*

sed -e s/Base\\\\//g \
	-e 's/extends Model/extends AbstractTable/g' \
	-e 's/Fia\([^s]\)/Fias\1/g' \
	-i $TMPDIR/*.php

mv $TMPDIR/Fia.php $TMPDIR/Fias.php


rename_method $TMPDIR/Breeder.php Staff ManagerId Id manager
rename_method $TMPDIR/Breeder.php Staff ApprovedBy Id approvedByManager
rename_method $TMPDIR/Breeder.php Fias NurseryRegionId Id nurseryRegion
rename_method $TMPDIR/Breeder.php Fias NurseryCityId Id nurseryCity
rename_method $TMPDIR/Breeder.php Fias NurseryCityDistrictId Id nurseryCityDistrict

remove_method $TMPDIR/Breeder.php breederBreeds BreederBreed FeedingOrders BreederId BreederBreedId
remove_method $TMPDIR/Breeder.php breederBreeds BreederBreed Orders BreederId BreederBreedId

remove_method $TMPDIR/BreederBreed.php breeders Breeder FeedingOrders BreederBreedId BreederId
remove_method $TMPDIR/BreederBreed.php breeders Breeder Orders BreederBreedId BreederId

rename_method $TMPDIR/Staff.php Breeder ManagerId Id managedBreeders
rename_method $TMPDIR/Staff.php Breeder ApprovedBy Id approvedBreeders
rename_method $TMPDIR/Staff.php Form CheckedOutBy Id checkedOutForms
rename_method $TMPDIR/Staff.php Form ValidatedBy Id validatedForms

rename_method $TMPDIR/Form.php Staff CheckedOutBy Id checkedOutByOperator
rename_method $TMPDIR/Form.php Staff ValidatedBy Id validatedByOperator

rename_method $TMPDIR/RegionManager.php Fias FiasId Id fias

rename_method $TMPDIR/Fias.php Fias ParentId Id parentRecord belongsTo
rename_method $TMPDIR/Fias.php Fias ParentId Id childRecords hasMany

rename_method $TMPDIR/Staff.php WorkGroup HeaderId Id headedWorkGroups
rename_method $TMPDIR/WorkGroup.php Staff HeaderId Id header



perl -i -p0e \
    's/    public function staff\(\) \{[^}]+\}\n\n//g' \
    $TMPDIR/Staff.php
perl -i -p0e \
    's/    public function [a-zA-Z0-9]+\(\) \{[\n ]+return \$this->hasMany\([\\A-Za-z]+::class, '"'(CreatedBy|DeletedBy)', 'Id'"'\);[\n ]+}\n\n//g' \
    $TMPDIR/Staff.php
perl -i -p0e \
    's/ *public function breeders\(\) \{[^}]+\}\n\n//g' \
    $TMPDIR/Fias.php


for model in `ls $TMPDIR`; do
	nonBaseModelFile=app/Models/$model
	if [[ ! -f ${nonBaseModelFile} ]]; then
		modelClass=`echo $model | sed s/\\.php$//g`
		echo -e "<?php\nnamespace App\\Models;\n\nclass $modelClass extends Base\\\\$modelClass {\n\t//\n}\n" > $nonBaseModelFile
	fi

    rename_method "$TMPDIR/$model" Staff CreatedBy Id createdByUser
    rename_method "$TMPDIR/$model" Staff DeletedBy Id deletedByUser

    if grep -q ${DELETED_AT} $TMPDIR/$model; then
        sed -e "0,/^use/{s/use [\\A-Za-z0-9]*;/use Illuminate\\\Database\\\Eloquent\\\SoftDeletes;\n\0/}" \
            -e "s/protected \$table = '[^']*';/use SoftDeletes;\n    const DELETED_AT = \'${DELETED_AT}\';\n\n    \\0/g" \
            -i $TMPDIR/$model
    fi
done

cp $TMPDIR/* app/Models/Base
rm -rf $TMPDIR

./artisan ide-helper:models -vvv -W && echo "$(tput bold)Satan was summoned successfully."

