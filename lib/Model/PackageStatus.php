<?php
/**
 * PackageStatus
 *
 * PHP version 5
 *
 * @category Class
 * @package  CrazyFactory\Spapi\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Selling Partner API for Fulfillment Inbound
 *
 * The Selling Partner API for Fulfillment Inbound lets you create applications that create and update inbound shipments of inventory to Amazon's fulfillment network.
 *
 * OpenAPI spec version: v1
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 2.4.17
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace CrazyFactory\Spapi\Client\Model;
use \CrazyFactory\Spapi\Client\ObjectSerializer;

/**
 * PackageStatus Class Doc Comment
 *
 * @category Class
 * @description The shipment status of the package.
 * @package  CrazyFactory\Spapi\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class PackageStatus
{
    /**
     * Possible values of this enum
     */
    const SHIPPED = 'SHIPPED';
    const IN_TRANSIT = 'IN_TRANSIT';
    const DELIVERED = 'DELIVERED';
    const CHECKED_IN = 'CHECKED_IN';
    const RECEIVING = 'RECEIVING';
    const CLOSED = 'CLOSED';
    const DELETED = 'DELETED';
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::SHIPPED,
            self::IN_TRANSIT,
            self::DELIVERED,
            self::CHECKED_IN,
            self::RECEIVING,
            self::CLOSED,
            self::DELETED,
        ];
    }
}


