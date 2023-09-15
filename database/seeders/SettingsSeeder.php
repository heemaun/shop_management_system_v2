<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //bg-color
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--1st-bg-color',
            'value'     => '#333333',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--2nd-bg-color',
            'value'     => '#4d4d4d',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--3rd-bg-color',
            'value'     => '#666666',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--4th-bg-color',
            'value'     => '#808080',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--5th-bg-color',
            'value'     => '#999999',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--6th-bg-color',
            'value'     => '#b3b3b3',
        ]);
        //bg-ends

        //color       
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--1st-color',
            'value'     => '#ffffff',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--2nd-color',
            'value'     => '#ffffff',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--3rd-color',
            'value'     => '#ffffff',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--4th-color',
            'value'     => '#ffffff',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--5th-color',
            'value'     => '#ffffff',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--6th-color',
            'value'     => '#ffffff',
        ]);
        //color-ends
        
        //font-size        
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--h2-font-size',
            'value'     => '36px',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--h3-font-size',
            'value'     => '32px',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--h4-font-size',
            'value'     => '28px',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--text-field-font-size',
            'value'     => '24px',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--label-font-size',
            'value'     => '20px',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--default-font-size',
            'value'     => '16px',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--th-font-size',
            'value'     => '20px',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--td-font-size',
            'value'     => '16px',
        ]);
        //font-size-ends
        
        //font-wieght        
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--h2-font-weight',
            'value'     => '900',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--h3-font-weight',
            'value'     => '800',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--h4-font-weight',
            'value'     => '700',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--text-field-font-weight',
            'value'     => '100',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--label-font-weight',
            'value'     => '200',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--default-font-weight',
            'value'     => '100',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--th-font-weight',
            'value'     => '900',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--td-font-weight',
            'value'     => '100',
        ]);
        //font-wieght-ends              
        
        //font-family        
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--h2-font-family',
            'value'     => 'roboto',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--h3-font-family',
            'value'     => 'roboto',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--h4-font-family',
            'value'     => 'roboto',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--text-field-font-family',
            'value'     => 'roboto',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--label-font-family',
            'value'     => 'roboto',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--default-font-family',
            'value'     => 'roboto',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--th-font-family',
            'value'     => 'roboto',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--td-font-family',
            'value'     => 'roboto',
        ]);
        //font-family-ends        
        
        //font-style        
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--h2-font-style',
            'value'     => 'normal',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--h3-font-style',
            'value'     => 'normal',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--h4-font-style',
            'value'     => 'normal',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--text-field-font-style',
            'value'     => 'normal',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--label-font-style',
            'value'     => 'normal',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--default-font-style',
            'value'     => 'normal',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--th-font-style',
            'value'     => 'normal',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--td-font-style',
            'value'     => 'normal',
        ]);
        //font-style-ends        
        
        //border-radius
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--text-field-border-radius',
            'value'     => '4px',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--button-border-radius',
            'value'     => '2px',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--section1-border-radius',
            'value'     => '16px',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--section2-border-radius',
            'value'     => '8px',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--section3-border-radius',
            'value'     => '4px',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--form-border-radius',
            'value'     => '8px',
        ]);
        //border-radius-ends
       
        //logo-designs
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--logo-color',
            'value'     => '#ffffff',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--logo-font-size',
            'value'     => '36px',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--logo-font-weight',
            'value'     => '900',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--logo-font-style',
            'value'     => 'normal',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--logo-font-family',
            'value'     => 'roboto',
        ]);
        //logo-designs-ends        
        
        //nav-designs
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--nav-bg-color',
            'value'     => '#1a1a1a',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--nav-color',
            'value'     => '#ffffff',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--nav-font-size',
            'value'     => '16px',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--nav-font-weight',
            'value'     => '400',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--nav-font-style',
            'value'     => 'normal',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--nav-font-family',
            'value'     => 'roboto',
        ]);
        //nav-designs-ends        
        
        //banner-designs
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--banner-color',
            'value'     => '#ffffff',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--banner-font-size',
            'value'     => '40px',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--banner-font-weight',
            'value'     => '900',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--banner-font-style',
            'value'     => 'normal',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--banner-font-family',
            'value'     => 'roboto',
        ]);
        //banner-designs-ends

        //buttons
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--button-default-bg-color',
            'value'     => '#e6e6e6',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--button-default-color',
            'value'     => '#1a1a1a',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--button-primary-bg-color',
            'value'     => '#0b5ed7',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--button-primary-color',
            'value'     => '#ffffff',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--button-secondary-bg-color',
            'value'     => '#6c757d',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--button-secondary-color',
            'value'     => '#ffffff',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--button-success-bg-color',
            'value'     => '#198754',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--button-success-color',
            'value'     => '#ffffff',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--button-info-bg-color',
            'value'     => '#0dcaf0',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--button-info-color',
            'value'     => '#000000',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--button-warning-bg-color',
            'value'     => '#ffc107',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--button-warning-color',
            'value'     => '#000000',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--button-danger-bg-color',
            'value'     => '#dc3545',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--button-danger-color',
            'value'     => '#ffffff',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--button-light-bg-color',
            'value'     => '#ffffff',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--button-light-color',
            'value'     => '#000000',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--button-dark-bg-color',
            'value'     => '#000000',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--button-dark-color',
            'value'     => '#ffffff',
        ]);
        //buttons ends
    }
}
