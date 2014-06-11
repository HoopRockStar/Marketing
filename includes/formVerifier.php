<?php
/**
 * FormVerifier class for verifying form data.
 *
 */
class FormVerifier {
    /*--- private variables ---*/
    private $errorList = array();
    private $cssClass;

    /*--- General purpose functions ---*/

    /**
     * Constructor
     *
     * @param $cssClass The CSS class name for errors.
     */
    function __construct($cssClass = "error") {
      $this->cssClass = $cssClass;
    }

    /**
     * Returns the value of a form field (name).
     *
     * @param $field The form field to get the value from.
     * @param $defaultVal The initial value for a form control.
     */
    function getValue($field, $defaultVal = "") {
        if (isset($_REQUEST[$field])) {
        return stripslashes($_REQUEST[$field]);
        }
        return $defaultVal;
    }

    /*--- Functions to clean up data ---*/

    /**
   * Strip phone and fax numbers of all non-numeric characters
   *
   * @param $field The form field, a phone or fax number
   * @return $field The phone or fax number stripped of all non-numeric characters
     */

    function cleanPhone($field) {
      $field = preg_replace("/[^a-zA-Z0-9]/", "", trim($field));
      return $field;
  }

  /**
   * Strip text of all characters except A-Z, a-z, 0-9, ', -
   *
   * @param $field The form field, text to be stripped of unwanted characters
   * @return The text stripped of all characters except A-Z, a-z, 0-9, ', -
     */

  function cleanText($field) {
    $field = preg_replace("/[^'a-zA-Z0-9\s-]/", "", trim($field));
    return $field;
  }


    /*--- Error tracking and reporting functions ---*/

    /**
     * Add errors to the error list
     *
     * @param $field The form field where the error occurred.
     * @param $value The value of the form field with the error.
     * @param $msg The error message presented to the user.
     */
    function addError($field, $value, $msg) {
        if (empty($this->errorList[$field])) {
            $this->errorList[$field] = array(
                "field" => $field,
                "value" => $value,
                "msg" => $msg);
        } else { // allow for multiple errors
        $errArray = $this->errorList[$field];
            // Do not add if a duplicate message
            if ($errArray["msg"] != $msg) {
                $this->errorList[] = array(
                    "field" => $field,
                    "value" => $value,
                    "msg" => $msg);
             }
        }
    }

    /**
     * Returns true if there are any error on the list, otherwise returns
     * false.
     */
    function isError() {
        if ($this->errorList) {
        return true;
        } else {
        return false;
        }
    }

    /**
     * Returns a list of messages for the specified field.
     *
     * @param $field The form field to check for error.
     * @return All the error messages for $field as an array.
     */
    function getErrorMessages($field) {
    $messages = array();
        foreach ($this->errorList as $err) {
            if ($err["field"] == $field) {
            $messages[] = $err["msg"];
            }
        }
        return $messages;
    }

    /**
     * Reset the error list to an empty list.
     */
    function resetErrorList() {
    $this->errorList = array();
    }

    /**
     * Highlight $formElement with a span tag if $field has an error.
     *
     * @param $field The form field to check for error.
     * @param $formElement The HTML code to display.
     */
    function formatOnError($field, $formElement) {
      $html = $formElement;
        if (isset($this->errorList[$field])) {
          $html = "<span class=\"$this->cssClass\">";
          $html .= $formElement.'</span>';
        }

      return $html;
    }

    /**
     * Return the first error message in a span tag if there is an
     * error or $formElement if there is no error.
     *
     * @param $field The form field to check for error.
     * @param $formElement The HTML to display when there is no error.
     */
    function showMessageOnError($field, $formElement = "") {
      $html = $formElement;
        if (isset($this->errorList[$field])) {
          $errArray = $this->errorList[$field];
          $html = "<span class=\"$this->cssClass\">";
          $html .= $errArray["msg"].'</span>';
        }
        return $html;
    }



    /**
     * Returns a default HTML message listing the errors found.
     */
    function reportErrors() {
      $html = "";
        if ($this->isError()) {
          $html = "<div class=\"errors\"><strong>We found some error(s) in the data.</strong>\n";
          $html .= "<p>Please resubmit after making these changes:</p>\n";
          $html .= "<ul>";
            foreach ($this->errorList as $err) {
              $html .= '<li>'.$err['msg']."</li>\n";
          }
          $html .= "</ul></div>";
        }
        return $html;
    }

    /*--- User input verification functions ---*/

    /**
     * Adds a $msg to the list if the form control $field is empty.
     *
     * @param $field The form field to check.
     * @param $msg The error message presented to the user.
     */
    // NTR: should be isNotEmpty
    function isEmpty($field, $msg) {
      $value = $this->getValue($field);
        if (!is_array($value) and trim($value) == "") {
        $this->addError($field, $value, $msg);
          return false;
        } else if (!is_array($value) and trim($value) == "-Select One-") {
      $this->addError($field, $value, $msg);
          return false;
        } else if (!is_array($value) and trim($value) == "selection") {
          $this->addError($field, $value, $msg);
          return false;
        } elseif (is_array($value) and empty($value)) {
          $this->addError($field, $value, $msg);
          return false;
        } elseif (is_array($value)) {
            foreach ($value as $item) {
                if ($item == "") {
                $this->addError($field, $value, $msg);
                return false;
                }
            }
        } else {
          return true;
        }
    }


    /**
     * Adds a $msg to the list if the form control $field is not numeric.
     *
     * @param $field The form field to check.
     * @param $msg The error message presented to the user.
     */
    function isNotNumeric($field, $msg) {
      $value = $this->getValue($field);
        if(!is_numeric($value)) {
          $this->addError($field, $value, $msg);
          return false;
        } else {
          return true;
        }
    }

  /**
   * Adds a $msg to the list if the form control $field is not a valid telephone number.
   *
   * @param $field The form field to check.
   * @param $msg The error message presented to the user.
     */
    function isInvalidPhone($field, $msg) {
      $value = $this->getValue($field);
      $value = $this->cleanPhone($value);
      $value = trim($value);
    if ($value == "") {
      return false;
    } else if (!is_numeric($value)) {
      $this->addError($field, $value, $msg);
      return true;
    } else if (($value < 1000000000) || ($value > 9999999999)) {
      $this->addError($field, $value, $msg);
      return true;
    } else {
      return false;
    }
     }

    /**
     * Adds a $msg to the list if the form control $field is not an integer.
     *
     * @param $field The form field to check.
     * @param $msg The error message presented to the user.
     */
    function isNotInteger($field, $msg) {
        $value = $this->getValue($field);
        if(!is_numeric($value) || $value != intval($value)) {
            $this->addError($field, $value, $msg);
            return false;
        } else {
            return true;
        }
    }

    /**
     * Adds a $msg to the list if the form control $field is not within a
     * numeric range.
     *
     * @param $field The form field to check.
     * @param $msg The error message presented to the user.
     */
    function isOutsideRange($field, $msg, $min, $max) {
        $value = $this->getValue($field);
        if(!is_numeric($value) OR $value < $min OR $value > $max) {
            $this->addError($field, $value, $msg);
            return false;
        } else {
            return true;
        }
    }

    /**
     * Adds a $msg to the list if the form control $field is not a valid
     * email address.
     *
     * @param $field The form field to check.
     * @param $msg The error message presented to the user.
     */
    function isInvalidEmail($field, $msg) {
        $value = $this->getValue($field);
        $pattern = "/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*";
        $pattern .= "@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)+/";
        $pattern1 = "[:space:]";
        if ($value == "") {
          return true;
        } else if(preg_match($pattern, $value)) {
            return true;
        } else {
            $this->addError($field, $value, $msg);
            return false;
        }
    }
}
?>
