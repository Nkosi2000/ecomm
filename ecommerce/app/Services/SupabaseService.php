<?php

namespace App\Services;

class SupabaseService
{
    protected string $baseUrl;
    protected string $apiKey;

    public function __construct()
    {
        // Ensure trailing slash is removed
        $this->baseUrl = rtrim(config('services.supabase.url'), '/');
        
        // Use the correct secret key for backend/admin panel
        $this->apiKey  = config('services.supabase.key');
        
        if (empty($this->baseUrl) || empty($this->apiKey)) {
            throw new \RuntimeException('Supabase configuration is missing. Check your .env and services.php.');
        }
    }

    public function from(string $table): SupabaseTable
    {
        return new SupabaseTable($this->baseUrl, $this->apiKey, $table);
    }
}