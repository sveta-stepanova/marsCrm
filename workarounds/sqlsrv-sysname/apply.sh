#!/bin/bash

if grep -qi sysname vendor/doctrine/dbal/lib/Doctrine/DBAL/Types/Type.php; then
    echo "Sysname DBAL patch already applied"
else
    cp workarounds/sqlsrv-sysname/SysnameType.php vendor/doctrine/dbal/lib/Doctrine/DBAL/Types/SysnameType.php
    sed \
        -e 's/self::DATEINTERVAL => DateIntervalType::class/self::DATEINTERVAL => DateIntervalType::class, self::SYSNAME => SysnameType::class/g' \
        -e "s/const DATEINTERVAL = 'dateinterval';/const DATEINTERVAL = 'dateinterval'; const SYSNAME = 'sysname';/g" \
        -i vendor/doctrine/dbal/lib/Doctrine/DBAL/Types/Type.php
    echo "Some ugly things were made, but model generator should be working"
fi
