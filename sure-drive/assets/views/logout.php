<?php

// End current session.
Session::unsetSessionVars();
Session::end();

// Redirect back to login.
Redirect::redirectTo('home');
