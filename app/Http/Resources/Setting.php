<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Setting extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'id' => $this->id,
            'business_name' => $this->business_name,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'slogan' => $this->slogan,
            'banner_img' => $this->banner_img,
            'about_title' => $this->about_title,
            'about_description' => $this->about_description,
            'about_img' => $this->about_img,
            'services_description' => $this->services_description,
            'clients_description' => $this->clients_description,
            'portfolio_description' => $this->portfolio_description,
            'testimonials_description' => $this->testimonials_description,
            'call_to_action_description' => $this->call_to_action_description,
            'contact_us_description' => $this->contact_us_description
        ];

    }
}
