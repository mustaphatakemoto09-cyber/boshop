<?php

declare(strict_types=1);

namespace App\Data\User;

use App\Models\User;
use Carbon\CarbonImmutable;
use Spatie\LaravelData\Attributes\Validation\BooleanType;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;

/**
 * Data Transfer Object for User model
 */
final class UserData extends Data
{
    public function __construct(
        #[Required, StringType]
        public string $username,

        #[Required, StringType]
        public string $name,

        #[Required, Email]
        public string $email,

        #[Required, StringType]
        public string $password,

        #[Nullable, StringType]
        public ?string $phone = null,

        #[Nullable, StringType]
        public ?string $bio = null,

        #[BooleanType]
        public bool $is_active = true,

        #[Nullable, StringType]
        public ?string $locale = null,

        #[Nullable]
        public ?CarbonImmutable $email_verified_at = null,

        #[Nullable, StringType]
        public ?string $address_line1 = null,

        #[Nullable, StringType]
        public ?string $address_line2 = null,

        #[Nullable, StringType]
        public ?string $city = null,

        #[Nullable, StringType]
        public ?string $state = null,

        #[Nullable, StringType]
        public ?string $postal_code = null,

        #[Nullable, StringType]
        public ?string $country = null,
    ) {}

    /**
     * Create UserData from User model
     */
    public static function fromModel(User $user): self
    {
        $username = $user->username;
        if (! is_scalar($username)) {
            $username = '';
        }

        $name = $user->name;
        if (! is_scalar($name)) {
            $name = '';
        }

        $email = $user->email;
        if (! is_scalar($email)) {
            $email = '';
        }

        $password = $user->password;
        if (! is_scalar($password)) {
            $password = '';
        }

        return new self(
            username: (string) $username,
            name: (string) $name,
            email: (string) $email,
            password: (string) $password,
            phone: $user->phone,
            bio: $user->bio,
            is_active: $user->is_active ?? true,
            locale: $user->locale,
            email_verified_at: $user->email_verified_at ? CarbonImmutable::instance($user->email_verified_at) : null,
            address_line1: $user->address_line1,
            address_line2: $user->address_line2,
            city: $user->city,
            state: $user->state,
            postal_code: $user->postal_code,
            country: $user->country,
        );
    }

    /**
     * Convert UserData to User model array
     *
     * @return array<string, mixed>
     */
    public function toModelArray(): array
    {
        return [
            'username' => $this->username,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'phone' => $this->phone,
            'bio' => $this->bio,
            'is_active' => $this->is_active,
            'locale' => $this->locale,
            'email_verified_at' => $this->email_verified_at,
            'address_line1' => $this->address_line1,
            'address_line2' => $this->address_line2,
            'city' => $this->city,
            'state' => $this->state,
            'postal_code' => $this->postal_code,
            'country' => $this->country,
        ];
    }

}
