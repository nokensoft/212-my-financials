@extends('errors.layout')

@section('icon', 'fa-solid fa-screwdriver-wrench')
@section('code', '503')
@section('title', 'Sedang Pemeliharaan')
@section('message', $exception?->getMessage() ?: 'Situs sedang dalam pemeliharaan untuk peningkatan layanan. Kami akan segera kembali. Terima kasih atas kesabaran Anda.')
