@extends('errors.layout')

@section('icon', 'fa-solid fa-lock')
@section('code', '403')
@section('title', 'Akses Ditolak')
@section('message', $exception?->getMessage() ?: 'Anda tidak memiliki izin untuk mengakses halaman ini. Bila Anda merasa ini keliru, silakan hubungi kami.')
