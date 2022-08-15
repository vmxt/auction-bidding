<?php

namespace App\Helpers\Webfocus;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Setting {

    public static function info() {

        $setting = DB::table('settings')->first();
        $setting->menu = DB::table('menus')->where('is_active', 1)->first();
        return $setting;

	}

	public static function getFaviconLogo()
    {
        $settings = DB::table('settings')->where('id',1)->first();

        return $settings;
    }

    public static function social_account($sm)
    {
        $account = DB::table('social_media')->where('name','=',$sm)->first();

        if($account === null){
            return false;
        }
        else{
            return $account;
        }

    }

    public static function getFooter()
    {
        $footer = DB::table('pages')->where('slug', 'footer')->where('name', 'footer')->first();

        return $footer;
    }

    public static function date_for_listing($date) {
        if ($date == null || trim($date) == '') {
            return "-";
        }
        else if ($date != null && strtotime($date) < strtotime('-1 day')) {
            return Carbon::parse($date)->isoFormat('lll');
        }

        return Carbon::parse($date)->diffForHumans();
	}

	public static function date_for_news_list($date) {
        if ($date != null && strtotime($date) > strtotime('-1 day')) {
            return Carbon::parse($date)->diffForHumans();
        } else {
			return 'on '.date('M d, Y h:i A', strtotime($date));
		}

    }

    public function social($page,$account){
    	if($page == 'facebook')
    		return '
				jsSocials.shares.facebook = {
	                logo: "fa fa-facebook-f",
	                shareUrl: "https://facebook.com/'.$account.'",
	                getCount: function(data) {
	                    return data.count;
	                }
	            };
    		';
    	elseif($page == 'twitter')
    		return '
				jsSocials.shares.twitter = {
	                logo: "fa fa-twitter",
	                shareUrl: "https://twitter.com/'.$account.'",
	                getCount: function(data) {
	                    return data.count;
	                }
	            };
    		';
    	elseif($page == 'instagram')
    		return '
				jsSocials.shares.instagram = {
	                logo: "fa fa-instagram",
	                shareUrl: "https://instagram.com/'.$account.'",
	                getCount: function(data) {
	                    return data.count;
	                }
	            };
    		';
    	elseif($page == 'google')
    		return '
				jsSocials.shares.googleplus = {
	                logo: "fa fa-google-plus",
	                shareUrl: "https://plus.google.com/'.$account.'",
	                getCount: function(data) {
	                    return data.count;
	                }
	            };
    		';
    	elseif($page == 'dribble')
    		return '
				jsSocials.shares.dribbble = {
	                logo: "fa fa-dribbble",
	                shareUrl: "https://dribbble.com/'.$account.'",
	                getCount: function(data) {
	                    return data.count;
	                }
	            };
    		';
    }

    public static function get_company_logo_storage_path()
    {
        $settings = DB::table('settings')->where('id',1)->first();

        if(trim($settings->company_logo) != "") 
            return asset('storage').'/public/logos/'.$settings->company_logo;

        return asset('theme/pmc_sms/supplier-portal/images/logo.png');

    }

    public static function get_company_favicon_storage_path()
    {
        $settings = DB::table('settings')->where('id',1)->first();

        if(trim($settings->company_logo) != "") 
            return asset('storage').'/public/icons/'.$settings->website_favicon;

        return '';
    }

    public static function availableBanks() {

        return [
            'A' => [
                'Al-Amanah Islamic Investment Bank of the Philippines',
                'Asia United Bank Corporation',
                'Australia and New Zealand Banking Group'
            ] ,
            'B' => [
                'Bank of Makati',
                'BDO Unibank, Inc.',
                'BDO Private Bank (a subsidiary of BDO Unibank, Inc.)',
                'Bank of Commerce',
                'Bank of the Philippine Islands',
                'Bangkok Bank Co. Ltd.',
                'Bank of China, Xiangtan Branch'
            ] , 
            'C' => [
                'Cathay United Bank Co. Ltd.',
                'Chang Hwa Commercial Bank LTD',
                'China Banking Corporation (Chinabank)',
                'CIMB Bank Philippines Inc.',
                'Citibank N.A., Singapore',
                'Citibank Philippines',
                'Coins.ph'
            ] ,
            'D' => [
                'Development Bank of the Philippines',
                'Deutsche Bank'
            ] ,
            'E' => [
                'East West Banking Corporation',
                'Enterprise Bank'
            ] , 
            'F' => [
                'First Commercial Bank Manila'
            ] ,
            'G' => [
                'Gcash'
            ] ,
            'H' => [
                'Hua Nan Commercial Bank Ltd. Manila'
            ] , 
            'J' => [
                'JPMorgan Chase & Co.'
            ] ,
            'L' => [
                'Land Bank of the Philippines'
            ] , 
            'M' => [
                'Malayan Banking Berhad',
                'Maybank Philippines, Inc.',
                'Mega International Commercial Bank Co. LTD',
                'Metropolitan Bank and Trust Company',
                'Mizuho Bank, LTD'
            ] ,
            'P' => [
                'PayMaya' ,
                'Philippine Bank of Communications' ,
                'Philippine National Bank' ,
                'Philippine Trust Company'
            ] ,
            'R' => [
                'Rizal Commercial Banking Corporation',
                'Robinsons Bank Corporation'
            ] ,
            'S' => [
                'Security Bank Corporation',
                'Standard Chartered Bank Philippines'
            ] ,
            'U' => [
                'Union Bank of the Philippines, Inc.',
                'United Coconut Planters Bank'
            ]

        ];

    }

}
