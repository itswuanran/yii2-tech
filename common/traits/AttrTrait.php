<?php

namespace common\traits;

trait AttrTrait
{

    public function attr()
    {
        return 'attr';
    }

    public function setAttr($key, $value)
    {
        $attrKey = $this->attr();
        $data = json_decode($this->$attrKey, true);
        if (empty($data)) {
            $data = [];
        }
        $data[$key] = $value;
        return $this->$attrKey = json_encode($data);
    }

    public function getAttr($key, $defaultVal = null)
    {
        $attrKey = $this->attr();
        $data = json_decode($this->$attrKey, true);
        if (empty($data)) {
            $data = [];
        }
        if (isset($data[$key])) {
            return $data[$key];
        }
        return $defaultVal;
    }

    public function clearAttr($key = null)
    {
        if (is_null($key)) {
            // delete all
            $attrKey = $this->attr();
            $this->$attrKey = '';
        } else {
            // delete an item
            $attrKey = $this->attr();
            $data = json_decode($this->$attrKey, true);
            if (empty($data)) {
                $data = [];
            }
            unset($data[$key]);
            $this->$attrKey = json_encode($data);
        }
    }
}
