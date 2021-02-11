<?php
declare(strict_types=1);

namespace Tests\Engine;

/**
 * @Table('Entities')
 * @Schema('dbo')
 */
class Entity {

    /**
     * @Attr('Identity')
     * @Type('Int')
     */
    public int $id;
    
    /**
     * @Attr('Unique')
     * @Type('String')
     */
    public string $name;
    
    /**
     * @Type('Datetime')
     * @Attr('Default', 'GetDate()', 'Function')
     */
    public string $birthDay;

}