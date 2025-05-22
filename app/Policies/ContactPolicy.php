<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Contact;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any contacts.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->hasPermission('view_contacts');
    }

    /**
     * Determine whether the admin can view the contact.
     */
    public function view(Admin $admin, Contact $contact): bool
    {
        return $admin->hasPermission('view_contact');
    }

    /**
     * Determine whether the admin can create contacts.
     */
    public function create(Admin $admin): bool
    {
        return $admin->hasPermission('create_contact');
    }

    /**
     * Determine whether the admin can update the contact.
     */
    public function update(Admin $admin, Contact $contact): bool
    {
        return $admin->hasPermission('update_contact');
    }

    /**
     * Determine whether the admin can delete the contact.
     */
    public function delete(Admin $admin, Contact $contact): bool
    {
        return $admin->hasPermission('delete_contact');
    }

    /**
     * Determine whether the admin can restore the contact.
     */
    public function restore(Admin $admin, Contact $contact): bool
    {
        return $admin->hasPermission('restore_contact');
    }

    /**
     * Determine whether the admin can permanently delete the contact.
     */
    public function forceDelete(Admin $admin, Contact $contact): bool
    {
        return $admin->hasPermission('force_delete_contact');
    }

    /**
     * Determine whether the admin can reply to the contact.
     */
    public function reply(Admin $admin, Contact $contact): bool
    {
        return $admin->hasPermission('reply_contact');
    }
} 