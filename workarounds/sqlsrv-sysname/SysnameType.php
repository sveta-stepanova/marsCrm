<?php

namespace Doctrine\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;


class SysnameType extends Type
{
	/**
	 * {@inheritdoc}
	 */
	public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
	{
		return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getDefaultLength(AbstractPlatform $platform)
	{
		return $platform->getVarcharDefaultLength();
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return Type::SYSNAME;
	}

	public function getMappedDatabaseTypes(AbstractPlatform $platform) {
		return [Type::SYSNAME];
	}

}
