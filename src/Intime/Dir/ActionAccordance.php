<?php

declare(strict_types = 1);

namespace Vgip\Intime\Dir;

use Vgip\Intime\Singleton;
use Vgip\Intime\Exception;

class ActionAccordance
{
    use Singleton;
    
    /**
     * Action accordance
     * 
     * Internal name => Intime name
     * 
     * @var array 
     */
    private $actionAccordance = [
        'country'                   => 'country_by_id',
        'region'                    => 'area_filtered',
        'district'                  => 'district_filtered',
        'locality'                  => 'locality_filtered',
        'branch'                    => 'branch_filtered',
        'branch_work_hours'         => 'branch_work_hours',
        'branch_api2'               => 'branch_by_dc',
        'goods_description'         => 'goods_desc_by_id',
        'packaging'                 => 'box_by_id',
        'declaration_create'        => 'declaration_insert_update',
        'declaration_update'        => 'declaration_update',
        'declaration_delete'        => 'declaration_delete',
        'declaration'               => 'info_tn',
        'declaration_calculate'     => 'declaration_calculate',
        'declaration_status'        => 'declaration_status_hist',
        'declaration_status_min'    => 'decl_status_history',
    ];
    
    private $answerArrayKey = [
        'declaration_create'        => 'declaration_ins_upd',
        'declaration_update'        => 'declaration_update',
        'declaration_delete'        => 'declaration_delete',
        'declaration'               => 'info_tn',
        'declaration_calculate'     => 'declaration_calculate',
        'declaration_status'        => 'declaration_status_hist',
        'declaration_status_min'    => 'get_decl_status_hist',
    ];
    
    private $answerArrayKeyPrefixDefault = [
        1 => 'Entries_',
        2 => 'Entry_',
    ];
    
    private $answerArrayKeyPrefixSpecial = [
        'declaration' => [
            1 => 'entries_',
            2 => 'entry_',
        ],
        'declaration_status' => [
            1 => 'entries_',
            2 => 'entry_',
        ],
    ];


    public function getActionNameIntimeByInternal(string $name): string
    {
        if (!isset($this->actionAccordance[$name])) {
            throw new Exception('Action with name '.$name.' not exist');
        }
        
        return $this->actionAccordance[$name];
    }
    
    public function getAnswerArrayKey(string $action): string
    {
        if (array_key_exists($action, $this->answerArrayKey)) {
            $anserArrayKey = $this->answerArrayKey[$action];
        } else {
            $anserArrayKey = 'get_'.$this->getActionNameIntimeByInternal($action);
        }
        
        return $anserArrayKey;
    }
    
    public function getPrefixes(string $action): array
    {
        if (array_key_exists($action, $this->answerArrayKeyPrefixSpecial)) {
            $res[1] = $this->answerArrayKeyPrefixSpecial[$action][1];
            $res[2] = $this->answerArrayKeyPrefixSpecial[$action][2];
        } else {
            $res[1] = $this->answerArrayKeyPrefixDefault[1];
            $res[2] = $this->answerArrayKeyPrefixDefault[2];
        }
        
        return $res;
    }
    
    public function getApiKeyName(string $action): string
    {
        $exceptionApiKeyName = [
            'declaration_update',
            'declaration_delete',
            'declaration_calculate',
        ];
        if (in_array($action, $exceptionApiKeyName)) {
            $apiKeyName = 'p_api_key';
        } else {
            $apiKeyName = 'api_key';
        }
        
        return $apiKeyName;
    }
}
