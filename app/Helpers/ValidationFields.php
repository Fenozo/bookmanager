<?php
namespace App\Helpers;

class ValidationFields {

    
    public function handle($data_page, $validations) {



        return $this->catchErroIfThisHas($data_page, $validations);
    }

    protected  function catchErroIfThisHas($data_page, $validations) {
        $errors = [];

        foreach($data_page as $key => $field) 
        {
            if (array_key_exists($key, $validations))
            {
                if (is_array($validations[$key])) {
                    
                    $conditions = (isset($validations[$key][0])) ? $validations[$key][0] : $validations[$key];
                   
                    if (is_string($conditions)) // le premier valeur est un chaine de caractère
                    {
                        $conditions = explode("|", $conditions);
                    }

                    foreach ($validations[$key] as $key_condition => $value_condition) {
                        
                        if ($key_condition == 'required') {

                            if (empty($field)) 
                            {  
                                $errors[$key] = $this->isValidateCondition($value_condition, $validations[$key]);
                            }
                        } else {
                            if (preg_match('#^min:([0-9]+)#', $key_condition, $matches)) {
                                if ($this->hasKeyInArray($matches, 1))
                                {
                                    if (strlen($field) < $matches[1])
                                    {
                                        $errors[$key] = $this->isValidateCondition($value_condition, $validations[$key]);
                                    }
                                }
                            }
                        }
                    }
                        
                    $message = $this->hasKeyInArray($validations[$key], 'message' );
                } else 
                    {
                        $message = $validations[$key];
                    }
                    if (\in_array('required', $validations))
                    {
                        if (empty($field)) 
                        {
                            $errors[$key] = $message;
                        } 
                    }
            } else 
            {
                $errors[$key] = [ 'error' => "attribute empty"];
            }
        } 
        
        
        return ['errors' => $errors];
    }



    private function hasKeyInArray($array, $key, $default = null) {
        return isset($array[$key]) ? $array[$key] : $default;
    }

    private function isValidateCondition($condition, $other_condition)
    {
        if (is_array($condition))
        {
            $message = $this->hasKeyInArray($condition,'message' ,  "Le champ et vide");
        } else 
            {
                $message = $this->hasKeyInArray($other_condition,'message' ,  "Le champ et vide");
            }
        return $message;
    }
}
?>