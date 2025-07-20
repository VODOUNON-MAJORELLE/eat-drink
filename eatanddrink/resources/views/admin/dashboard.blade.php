@extends('layouts.admin')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
@endpush
@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Eat&Drink Festival</title>
</head>
<body>
    <!-- Dashboard -->
    <section class="dashboard-section">
        <div class="dashboard-container">
            <div class="dashboard-header">
                <h1 class="dashboard-title">🛡️ Dashboard Administrateur</h1>
                <p class="dashboard-subtitle">Gestion globale du festival Eat&Drink</p>
            </div>

            <!-- Statistiques globales -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="stat-number" id="total-stands">{{ $stats['total_stands'] ?? 0 }}</div>
                    <div class="stat-label">Stands actifs</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number" id="total-visitors">{{ number_format($stats['visiteurs'] ?? 0, 0, ',', ' ') }}</div>
                    <div class="stat-label">Visiteurs attendus</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="stat-number" id="pending-requests">{{ $stats['demandes_en_attente'] ?? 0 }}</div>
                    <div class="stat-label">Demandes en attente</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-number" id="total-revenue">{{ $stats['chiffre_affaires'] ?? '0' }}</div>
                    <div class="stat-label">FCFA de chiffre d'affaires</div>
                </div>
            </div>

            <!-- Actions rapides -->
            <div class="quick-actions">
                <h3>⚡ Actions rapides</h3>
                <div class="actions-grid">
                    <a href="{{ route('admin.demandes') }}" class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <div class="action-title">Gérer les demandes</div>
                        <div class="action-description">Approuver les candidatures</div>
                    </a>
                    <a href="#" class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="action-title">Analyses</div>
                        <div class="action-description">Statistiques détaillées</div>
                    </a>
                    <a href="#" class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <div class="action-title">Gérer les utilisateurs</div>
                        <div class="action-description">Contrôle des accès</div>
                    </a>
                    <a href="#" class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div class="action-title">Paramètres</div>
                        <div class="action-description">Configuration système</div>
                    </a>
                </div>
            </div>

            <!-- Demandes en attente -->
            <div class="pending-requests">
                <h3>📋 Demandes en attente</h3>
                <div class="requests-list" id="requests-list">
                    @forelse($pendingRequests as $request)
                        <div class="request-item">
                            <div class="request-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="request-details">
                                <div class="request-name">{{ $request->company_name ?? $request->name }}</div>
                                <div class="request-info">{{ $request->activity_type ?? 'Type inconnu' }} • {{ $request->created_at->format('d/m/Y') }}</div>
                            </div>
                            <div class="request-actions">
                                <form method="POST" action="{{ route('admin.demandes.approuver', $request->id) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="approve-btn"><i class="fas fa-check"></i> Approuver</button>
                                </form>
                                <form method="POST" action="{{ route('admin.demandes.rejeter', $request->id) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="reject-btn"><i class="fas fa-times"></i> Rejeter</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div style="text-align:center; color:#aaa;">Aucune demande en attente</div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-logo">
                <i class="fas fa-utensils"></i>
                EAT&DRINK
            </div>
            <div class="footer-links">
                <a href="#apropos">À propos</a>
                <a href="#contact">Contact</a>
                <a href="#partenaires">Partenaires</a>
                <a href="#mentions">Mentions légales</a>
            </div>
            <p>&copy; 2025 Eat&Drink Festival. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>
@endsection 