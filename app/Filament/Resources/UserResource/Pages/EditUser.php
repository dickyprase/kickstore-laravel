<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Pastikan role tidak diubah menjadi admin
        $data['role'] = 'user';
        
        // Hash password jika ada perubahan
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        
        return $data;
    }
    
    // Prevent accessing admin users
    protected function authorizeAccess(): void
    {
        parent::authorizeAccess();
        
        $record = $this->getRecord();
        
        abort_if(
            $record->role === 'admin',
            403,
            'You are not authorized to edit admin users'
        );
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}