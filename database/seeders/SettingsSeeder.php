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
            'value'     => '#0000cc',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--2nd-bg-color',
            'value'     => '#0000ff',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--3rd-bg-color',
            'value'     => '#3333ff',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--4th-bg-color',
            'value'     => '#6666ff',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--5th-bg-color',
            'value'     => '#9999ff',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--6th-bg-color',
            'value'     => '#ccccff',
        ]);
        //bg-ends

        //color       
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--1st-color',
            'value'     => '#ffff33',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--2nd-color',
            'value'     => '#ffff00',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--3rd-color',
            'value'     => '#cccc00',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--4th-color',
            'value'     => '#666600',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--5th-color',
            'value'     => '#333300',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--6th-color',
            'value'     => '#000000',
        ]);
        //color-ends
        
        //font-size        
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--h2-font-size',
            'value'     => '56px',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--h3-font-size',
            'value'     => '48px',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--h4-font-size',
            'value'     => '40px',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--text-field-font-size',
            'value'     => '32px',
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
            'value'     => '600',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--label-font-weight',
            'value'     => '300',
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
            'value'     => '30px',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--button-border-radius',
            'value'     => '25px',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--div1-border-radius',
            'value'     => '20px',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--div2-border-radius',
            'value'     => '15px',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--div3-border-radius',
            'value'     => '10px',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--div4-border-radius',
            'value'     => '5px',
        ]);
        //border-radius-ends
       
        //logo-designs
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--logo-color',
            'value'     => '#339933',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--logo-font-size',
            'value'     => '37px',
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
            'value'     => '#1a1a4d',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--nav-color',
            'value'     => '#40bf40',
        ]);
        Setting::create([
            'admin_id'  => 1,
            'key'       => '--nav-font-size',
            'value'     => '17',
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
            'value'     => '#40bfbf',
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
    }
}
