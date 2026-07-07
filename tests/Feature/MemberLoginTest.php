<?php

namespace Tests\Feature;

use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MemberLoginTest extends TestCase
{
    use RefreshDatabase;

    private function createMember(array $overrides = []): Member
    {
        return Member::create(array_merge([
            'name' => 'Budi Santoso',
            'phone' => '081234567890',
            'password' => 'rahasia123',
            'status' => Member::STATUS_VERIFIED,
        ], $overrides));
    }

    public function test_halaman_login_menampilkan_field_nomor_hp(): void
    {
        $this->get(route('member.login'))
            ->assertOk()
            ->assertSee('Nomor HP')
            ->assertSee('name="phone"', false);
    }

    public function test_member_bisa_login_dengan_nomor_hp_dan_kata_sandi_benar(): void
    {
        $this->createMember([
            'phone' => '081234567890',
            'password' => 'rahasia123',
        ]);

        $response = $this->post(route('member.login'), [
            'phone' => '081234567890',
            'password' => 'rahasia123',
        ]);

        $response->assertRedirect(route('member.dashboard'));
        $this->assertAuthenticated('member');
        $this->assertSame('081234567890', auth('member')->user()->phone);
    }

    public function test_login_gagal_jika_kata_sandi_salah(): void
    {
        $this->createMember([
            'phone' => '081234567890',
            'password' => 'rahasia123',
        ]);

        $response = $this->from(route('member.login'))->post(route('member.login'), [
            'phone' => '081234567890',
            'password' => 'kata-sandi-salah',
        ]);

        $response->assertRedirect(route('member.login'))
            ->assertSessionHasErrors('phone');
        $this->assertGuest('member');
    }

    public function test_login_gagal_jika_nomor_hp_tidak_terdaftar(): void
    {
        $response = $this->from(route('member.login'))->post(route('member.login'), [
            'phone' => '080000000000',
            'password' => 'rahasia123',
        ]);

        $response->assertRedirect(route('member.login'))
            ->assertSessionHasErrors('phone');
        $this->assertGuest('member');
    }

    public function test_login_wajib_mengisi_nomor_hp_dan_kata_sandi(): void
    {
        $response = $this->from(route('member.login'))->post(route('member.login'), [
            'phone' => '',
            'password' => '',
        ]);

        $response->assertSessionHasErrors(['phone', 'password']);
        $this->assertGuest('member');
    }

    public function test_opsi_ingat_saya_menetapkan_remember_token(): void
    {
        $member = $this->createMember([
            'phone' => '081234567890',
            'password' => 'rahasia123',
        ]);

        $this->post(route('member.login'), [
            'phone' => '081234567890',
            'password' => 'rahasia123',
            'remember' => 'on',
        ])->assertRedirect(route('member.dashboard'));

        $this->assertAuthenticated('member');
        $this->assertNotNull($member->fresh()->remember_token);
    }
}
