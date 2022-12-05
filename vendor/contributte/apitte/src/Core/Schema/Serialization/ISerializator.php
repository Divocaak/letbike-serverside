<?php declare(strict_types = 1);

namespace Apitte\Core\Schema\Serialization;

use Apitte\Core\Schema\SchemaBuilder;

interface ISerializator
{

	/**
	 * @return mixed
	 */
	public function serialize(SchemaBuilder $builder);

}
