@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/entrepreneur-statut.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush
@section('content')
<section class="status-section" style="min-height:calc(100vh - 100px);margin-top:100px;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#f8fafc 0%,#f3f4f6 100%);">
    <div class="status-card" style="width:100%;max-width:520px;margin:auto;text-align:center;padding:4rem 2.5rem;box-shadow:0 8px 32px rgba(0,0,0,0.10);border-radius:32px;background:#fff;">
        @if(Auth::user()->statut === 'approuve')
            <div style="font-size:5rem;color:#4CAF50;margin-bottom:2rem;">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2 style="color:#222;font-weight:700;margin-bottom:1.5rem;font-size:2rem;">Votre inscription a été approuvée</h2>
            <p style="color:#555;font-size:1.15rem;">Félicitations ! Vous pouvez maintenant accéder à toutes les fonctionnalités de l'espace entrepreneur.</p>
        @else
            <div style="font-size:5rem;color:#FFA500;margin-bottom:2rem;">
                <i class="fas fa-hourglass-half"></i>
            </div>
            <h2 style="color:#222;font-weight:700;margin-bottom:1.5rem;font-size:2rem;">Votre demande est en cours de validation</h2>
            <p style="color:#555;font-size:1.15rem;">Notre équipe examine actuellement votre demande. Vous recevrez un email dès qu'une décision sera prise.</p>
        @endif
    </div>
</section>
@endsection 