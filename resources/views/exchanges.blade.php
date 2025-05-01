@extends('layout')
@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Trouver des échanges
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                {{-- <div class="row g-4">
                    <div class="col-md-3">
                        <form action="/exchange.php" method="get" class="sticky-top">
                            <div class="form-label">Filtrer</div>
                            <div class="mb-4">
                                <label class="form-check">
                                    <input type="radio" class="form-check-input" name="option" value="1"
                                        checked="checked">
                                    <span class="form-check-label">Matcher mes doubles avec les doubles des autres</span>
                                </label>
                                <label class="form-check">
                                    <input type="radio" class="form-check-input" name="option" value="2">
                                    <span class="form-check-label">Ne chercher que des doubles que je ne possède pas</span>
                                </label>
                                <label class="form-check">
                                    <input type="radio" class="form-check-input" name="option" value="3">
                                    <span class="form-check-label">Ne chercher que des personnes qui ne possèdent pas mes
                                        doubles</span>
                                </label>
                            </div>
                            <div class="form-label">Pays</div>
                            <div class="mb-4">
                                <select class="form-select">
                                    <option>Tout</option>
                                    <option>Allemagne</option>
                                    <option>France</option>
                                    <option>Suisse</option>
                                    <option>Belgique</option>
                                </select>
                            </div>
                            <div class="mt-5">
                                <button class="btn btn-primary w-100">
                                    Valider
                                </button>
                            </div>
                        </form>
                    </div> --}}
                <div class="col-12">
                    <div class="card" style="border-color:#fff;">
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table">
                                <tbody>
                                    @forelse ($exchangeSuggestions as $suggestion)
                                        <tr style="border-color:#fff;">
                                            <td>
                                                <div class="d-flex py-1 align-items-center">
                                                    <div class="flex-fill">
                                                        <div class="font-weight-medium"><strong>Je peux demander
                                                                :</strong></div>
                                                        <div>
                                                            @foreach ($suggestion['theyCanGive'] as $sticker)
                                                                <span
                                                                    class="badge badge-lg bg-green text-green-fg">{{ $sticker->sticker->id }}</span>
                                                            @endforeach
                                                        </div>
                                                        <br>
                                                        <div class="font-weight-medium"><strong>Je peux proposer
                                                                :</strong></div>
                                                        <div>
                                                            @forelse ($suggestion['iCanGive'] as $mySticker)
                                                                <span
                                                                    class="badge badge-lg bg-red text-red-fg">{{ $mySticker->sticker->id }}</span>
                                                            @empty
                                                                <li>Tu n’as rien à leur proposer</li>
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td data-label="Title">
                                                <div>
                                                    {{ $suggestion['other_user']->firstname . ' ' . $suggestion['other_user']->name }}
                                                </div>
                                                <div class="text-secondary">France</div>
                                            </td>
                                            <td>
                                                <div class="btn-list flex-nowrap">
                                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#modal-team">
                                                        Contacter
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr style="border-color:#fff;">
                                            <td colspan="3" style="height: 30px; border: none; background: #f6f8fb;">
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
