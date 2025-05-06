@extends('layout')
@section('content')
<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col-sm-12 col-md-10 col-xl">
                    <h2 class="page-title">
                        Mes stickers
                    </h2>
                </div>
                <div class="col-sm-12 col-md-2 col-xl-auto ms-auto d-print-none">
                    <a href="/" class="btn btn-outline-primary w-100">
                        Rafraîchir stats
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-sm-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Nombre de stickers possédés</div>
                            </div>
                            <div class="h1 mb-3">{{ $totalPosseded }} / 156</div>
                            <div class="d-flex mb-2">
                                <div>Taux remplissage</div>
                                <div class="ms-auto">
                                    <span class="text-green d-inline-flex align-items-center lh-1">
                                        {{ $tauxPosseded }}%
                                    </span>
                                </div>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-success" style="width: {{ $tauxPosseded }}%"
                                    role="progressbar" aria-valuenow="{{ $tauxPosseded }}" aria-valuemin="0"
                                    aria-valuemax="100" aria-label="{{ $tauxPosseded }}% Complete">
                                    <span class="visually-hidden">{{ $tauxPosseded }}% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Nombre de doubles</div>
                            </div>
                            <div class="h1 mb-3">{{ $totalDoubles }}</div>
                            <div class="d-flex mb-2">
                                <div>Taux de doubles</div>
                                <div class="ms-auto">
                                    <span class="text-green d-inline-flex align-items-center lh-1">
                                        {{ $tauxDoubles }}%
                                    </span>
                                </div>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-primary" style="width: {{ $tauxDoubles }}%"
                                    role="progressbar" aria-valuenow="{{ $tauxDoubles }}" aria-valuemin="0"
                                    aria-valuemax="100" aria-label="{{ $tauxDoubles }}% Complete">
                                    <span class="visually-hidden">{{ $tauxDoubles }}% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Nombre de stickers manquants</div>
                            </div>
                            <div class="h1 mb-3">{{ $totalMissing }}</div>
                            <div class="d-flex mb-2">
                                <div>Taux stickers manquants</div>
                                <div class="ms-auto">
                                    <span class="text-green d-inline-flex align-items-center lh-1">
                                        {{ $tauxMissing }}%
                                    </span>
                                </div>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-danger" style="width: {{ $tauxMissing }}%"
                                    role="progressbar" aria-valuenow="{{ $tauxMissing }}" aria-valuemin="0"
                                    aria-valuemax="100" aria-label="{{ $tauxMissing }}% Complete">
                                    <span class="visually-hidden">{{ $tauxMissing }}% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-striped">
                                <thead>
                                    <tr>
                                        <th>Numéro</th>
                                        <th>Catégorie</th>
                                        <th>Etat</th>
                                        <th>Modifier</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stickers as $stickerUser)
                                    <tr>
                                        <td>{{ $stickerUser->sticker->number }}</td>
                                        <td class="text-secondary">
                                            {{ $stickerUser->sticker->category->name }}
                                        </td>
                                        <td class="text-secondary state-display"
                                            data-sticker-id="<?php echo $stickerUser['sticker_id']; ?>">
                                            <?php
                                            if ($stickerUser->state_id == 1) {
                                                echo '<span class="badge bg-red text-red-fg">' . $stickerUser->state->name . '</span>';
                                            } elseif ($stickerUser->state_id == 2) {
                                                echo '<span class="badge bg-green text-green-fg">' . $stickerUser->state->name . '</span>';
                                            } elseif ($stickerUser->state_id == 3) {
                                                echo '<span class="badge bg-blue text-blue-fg">' . $stickerUser->state->name . '</span>';
                                            } elseif ($stickerUser->state_id == 4) {
                                                echo '<span class="badge bg-yellow text-yellow-fg">' . $stickerUser->state->name . '</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <select class="form-select sticker-status"
                                                data-sticker-id="<?php echo $stickerUser['sticker_id']; ?>">
                                                <option value="1" <?php if ($stickerUser->state_id == 1) {
                                                                        echo 'selected';
                                                                    } ?>>Manquant</option>
                                                <option value="2" <?php if ($stickerUser->state_id == 2) {
                                                                        echo 'selected';
                                                                    } ?>>Possédé</option>
                                                <option value="3" <?php if ($stickerUser->state_id == 3) {
                                                                        echo 'selected';
                                                                    } ?>>Double</option>
                                                <option value="4" <?php if ($stickerUser->state_id == 4) {
                                                                        echo 'selected';
                                                                    } ?>>En cours d'échange</option>
                                            </select>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.sticker-status').on('change', function() {
            let newState = $(this).val();
            let stickerId = $(this).data('sticker-id');
            let userId = $(this).data('user-id');

            const stateInfo = {
                1: {
                    text: 'Manquant',
                    badgeClass: 'bg-red text-red-fg'
                },
                2: {
                    text: 'Possédé',
                    badgeClass: 'bg-green text-green-fg'
                },
                3: {
                    text: 'Double',
                    badgeClass: 'bg-blue text-blue-fg'
                },
                4: {
                    text: 'En cours d\'échange',
                    badgeClass: 'bg-yellow text-yellow-fg'
                }
            };

            $.ajax({
                url: "{{ route('update-sticker') }}",
                type: "POST",
                data: {
                    id: stickerId,
                    user_id: userId,
                    value: newState,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    const $stateDisplay = $(
                        `.state-display[data-sticker-id="${stickerId}"]`);
                    $stateDisplay.html(
                        `<span class="badge ${stateInfo[newState].badgeClass}">${stateInfo[newState].text}</span>`
                    );
                },
                error: function(xhr) {
                    alert('Erreur : ' + xhr.responseJSON.message);
                }
            });
        });
    });
</script>
@endsection
