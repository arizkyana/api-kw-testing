<?php

namespace App\Utils;

trait RequestParser {
    public function filtering($query) {
        if(!empty($query)) {
            $attr_name = "";
            $keyword = "";
            $val = "";
            $str = null;
            foreach($query as $attr => $val) {
                $attr_name = $attr;
                foreach($val as $key => $v) {
                    $keyword = $key;
                    $val = $v;
                }
            }
            // check not query
            $neg = explode("!", $keyword);
            $keyword = isset($neg[1]) ? $neg[1] : $neg[0];
            
            if (isset($neg[1])) {
                if ($keyword === 'like') {
                    $match = explode("*", $val);
                    
                    if (isset($match[1])) {
                        $str = " NOT LIKE '%" . $match[1] . "' ";
                    } else {
                        $str = " NOT LIKE '%" . $match[0] . "%'";
                    }
                    
                    
                }
                
                if ($keyword === 'is') {
                    $str = " != '{$val}'" ;
                }
                
                if ($keyword === 'in') {
                    $exp = explode(",", $val);
                    $new_val = [];
                    foreach($exp as $_exp) {
                        array_push($new_val, "'{$_exp}'");
                    }
                    $new_val = implode(",", $new_val);
                    $str = " NOT IN ({$new_val})";
                }
            } else {
                if ($keyword === 'like') {
                    $match = explode("*", $val);
                    
                    if (isset($match[1])) {
                        $str = " LIKE '%" . $match[1] . "' ";
                    } else {
                        $str = " LIKE '%" . $match[0] . "%' ";
                    }
                    
                }
                
                if ($keyword === 'is') {
                    $str = " = '{$val}'" ;
                }
                
                if ($keyword === 'in') {
                    $exp = explode(",", $val);
                    $new_val = [];
                    foreach($exp as $_exp) {
                        array_push($new_val, "'{$_exp}'");
                    }
                    $new_val = implode(",", $new_val);
                    $str = " IN ({$new_val})";
                }
            }
            
            return ['attr' => $attr_name, 'str' => $str];
        }
        
    }
    public function sorting($query) {
        $str = null;
        if (!empty($query)) {
            $neg = explode("-", $query);
            
            if (isset($neg[1])) {
                $str = ['field' => $neg[1], 'order' => 'DESC'];
            } else {
                $str = ['field' => $neg[0], 'order' => 'ASC'];
            }
        }
        
        return $str;
    }
    public function limit($query){
        if (isset($query['limit']) && isset($query['offset'])){
            if(intval($query['limit']) > 0 && intval($query['offset']) >= 0) {
                return ['limit' => intval($query['limit']), 'offset' => intval($query['offset'])];
            } else {
                return ['error' => 'page limit and offset must more than 0'];
            }
        } else {
            
            return ['error' => 'page limit and offset are required'];
        }
    }
    public function paging($query){
        if (isset($query['limit']) && isset($query['offset'])){
            if(intval($query['limit']) > 0 && intval($query['offset']) >= 0) {
                return $query;
            } else {
                abort(400, 'page limit and offset must more than 0');
            }
        } else {
            abort(400, 'page limit and offset are required');
        }
    }
}