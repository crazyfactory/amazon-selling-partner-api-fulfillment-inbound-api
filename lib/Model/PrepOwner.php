<?php
/**
 * PrepOwner
 *
 * PHP version 5
 *
 * @category Class
 * @package  CrazyFactory\SpapiClient
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

namespace CrazyFactory\SpapiClient\Model;
use \CrazyFactory\SpapiClient\ObjectSerializer;

/**
 * PrepOwner Class Doc Comment
 *
 * @category Class
 * @description Indicates who will prepare the item.
 * @package  CrazyFactory\SpapiClient
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class PrepOwner
{
    /**
     * Possible values of this enum
     */
    const AMAZON = 'AMAZON';
    const SELLER = 'SELLER';
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::AMAZON,
            self::SELLER,
        ];
    }
}


