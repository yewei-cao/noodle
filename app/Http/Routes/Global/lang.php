<?php


// use Illuminate\Support\Facades\Lang;
/**
 * Sets the specified locale to the session
 */
get('lang/{lang}', function($lang)
{
	
// 	App::setLocale('cn');

// 	\App::setLocale('cn');
	
	
	
	
	
// 	App::setLocale('cn');111
	
	
// 	return Lang::get('menus.dashboard', array(), 'cn');
	
// 	return $lang;
	session()->put('locale', $lang);   
    
//     return Session::get ('locale');
	
// 	return session()->get('local');
	return redirect()->back();
});