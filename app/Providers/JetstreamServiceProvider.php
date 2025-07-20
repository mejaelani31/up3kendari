<?php

namespace App\Providers;

use App\Actions\Jetstream\AddTeamMember;
use App\Actions\Jetstream\CreateTeam;
use App\Actions\Jetstream\DeleteTeam;
use App\Actions\Jetstream\DeleteUser;
use App\Actions\Jetstream\InviteTeamMember;
use App\Actions\Jetstream\RemoveTeamMember;
use App\Actions\Jetstream\UpdateTeamName;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configurePermissions();

        Jetstream::createTeamsUsing(CreateTeam::class);
        Jetstream::updateTeamNamesUsing(UpdateTeamName::class);
        Jetstream::addTeamMembersUsing(AddTeamMember::class);
        Jetstream::inviteTeamMembersUsing(InviteTeamMember::class);
        Jetstream::removeTeamMembersUsing(RemoveTeamMember::class);
        Jetstream::deleteTeamsUsing(DeleteTeam::class);
        Jetstream::deleteUsersUsing(DeleteUser::class);


        // --- MULAI: Pindahkan Definisi Gate ke Sini ---
        /**
         * Gate untuk memeriksa "Role Sistem".
         */
        Gate::define('has-role', function (User $user, string $role) {
            if ($user->employee) {
                return $user->employee->role === $role;
            }
            return false;
        });

        /**
         * Gate untuk memeriksa "Role pada Unit".
         */
        Gate::define('has-unit-role', function (User $user, string $unitRole) {
            if ($user->employee) {
                return $user->employee->unit_role === $unitRole;
            }
            return false;
        });

        /**
         * Gate gabungan untuk memeriksa Role Sistem DAN Role pada Unit.
         */
        Gate::define('is-role-in-unit', function (User $user, array $roles) {
            if (count($roles) < 2) {
                return false;
            }
            $systemRole = $roles[0];
            $unitRole = $roles[1];
            if ($user->employee) {
                return $user->employee->role === $systemRole && $user->employee->unit_role === $unitRole;
            }
            return false;
        });

        // --- SELESAI: Definisi Gate ---
        
        Gate::define('access-unit-item', function (User $user, Model $item) {
            if (!$user->employee) {
                return false;
            }
            if ($user->employee->role === 'admin') {
                return true;
            }
            // Pastikan model target punya properti 'unit_role'
            if (!isset($item->unit_role)) {
                return false;
            }
            $userUnitRole = $user->employee->unit_role;
            $targetUnitRole = $item->unit_role;
            if (empty($userUnitRole)) {
                return $user->id === ($item->user_id ?? null);
            }
            return str_starts_with($targetUnitRole, $userUnitRole);
        });
    }

    /**
     * Configure the roles and permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::role('admin', 'Administrator', [
            'create',
            'read',
            'update',
            'delete',
        ])->description('Administrator users can perform any action.');

        Jetstream::role('editor', 'Editor', [
            'read',
            'create',
            'update',
        ])->description('Editor users have the ability to read, create, and update.');
    }
}
