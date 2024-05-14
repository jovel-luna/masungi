<?php

namespace App\Models\CompanyInquiries;

use App\Extenders\Models\BaseModel as Model;

class CompanyInquiry extends Model
{
    /**
     * @Render
     */
    public function renderShowUrl($prefix = 'admin') {
        $route = $this->id;

        if ($prefix == 'web') {
            $route = [$this->id, $this->slug];
        }

        return route($prefix . '.companyinquiries.show', $route);
    }

    public function renderArchiveUrl($prefix = 'admin') {
        return route($prefix . '.companyinquiries.archive', $this->id);
    }

    public function renderRestoreUrl($prefix = 'admin') {
        return route($prefix . '.companyinquiries.restore', $this->id);
    }


    public function renderWebHome() {
        return route('web.home');
    }

    /**
     * @Setters
     */
    public static function store($request, $item = null, $columns = ['name', 'leadcontact','position', 'email', 'contact_number', 'purpose','preferreddate','participants','concerns'])
    {
        $vars = $request->only($columns);
        
        if (!$item) {
            $item = static::create($vars);
        } else {
            $item->update($vars);
        }

        return $item;
    }

}
