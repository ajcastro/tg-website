<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class WebsiteSetting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        'title',
        'brand_name',
        'logo',
        'favicon',
        'jackpot_image',
        'running_text_announcement',
        'livechat_url',
        'livechat_code',
        'on_maintenance_mode',
        'timezone',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'website_id' => 'integer',
        'on_maintenance_mode' => 'boolean',
    ];

    protected $appends = [
        'logo_url',
        'favicon_url',
        'jackpot_image_url',
    ];


    public static function booted()
    {
        static::saving(function (WebsiteSetting $setting) {
            $setting->website->is_active = !$setting->on_maintenance_mode;
            $setting->website->saveQuietly();
        });
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function setLogoAttribute($value)
    {
        if ($value instanceof UploadedFile) {
            /** @var UploadedFile $value */
            $this->attributes['logo'] = $value->store("website/{$this->website_id}/images");
        } else {
            $this->attributes['logo'] = $value;
        }
    }

    public function setFaviconAttribute($value)
    {
        if ($value instanceof UploadedFile) {
            /** @var UploadedFile $value */
            $this->attributes['favicon'] = $value->store("website/{$this->website_id}/images");
        } else {
            $this->attributes['favicon'] = $value;
        }
    }

    public function setJackpotImageAttribute($value)
    {
        if ($value instanceof UploadedFile) {
            /** @var UploadedFile $value */
            $this->attributes['jackpot_image'] = $value->store("website/{$this->website_id}/images");
        } else {
            $this->attributes['jackpot_image'] = $value;
        }
    }

    public function getLogoUrlAttribute()
    {
        return storage_disk_url($this->logo);
    }

    public function getFaviconUrlAttribute()
    {
        return storage_disk_url($this->favicon);
    }

    public function getJackpotImageUrlAttribute()
    {
        return storage_disk_url($this->jackpot_image);
    }
}
