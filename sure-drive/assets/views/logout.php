<?php

// End current session.
Session::unset_session_vars();
Session::end_session();

// Redirect back to login.
Redirect::redirect_to('home');
