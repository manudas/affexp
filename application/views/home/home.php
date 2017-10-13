<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    // $this -> load -> view('merchant/merchant_logo_view', $data);
    /*
     * IN NESTED VIEWS WE DONT NEED TO LOAD $data_vars AGAIN BECAUSE
     * IT'S ALREADY LOADED IN THE FIRST $this -> load -> view CALL
     */
    $this -> load -> view('merchant/merchant_logo_view');