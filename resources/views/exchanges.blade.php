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
                                                            @php($theyCanGive = '')
                                                            @foreach ($suggestion['theyCanGive'] as $sticker)
                                                                <span
                                                                    class="badge badge-lg bg-green text-green-fg">{{ $sticker->sticker->id }}</span>
                                                                @php($theyCanGive .= $sticker->sticker->id . ', ')
                                                            @endforeach
                                                            <span class="theyCanGive"
                                                                style="display:none;">{{ $theyCanGive }}</span>
                                                        </div>
                                                        <br>
                                                        <div class="font-weight-medium"><strong>Je peux proposer
                                                                :</strong></div>
                                                        <div>
                                                            @php($iCanGive = '')
                                                            @if ($suggestion['iCanGive'] == null)
                                                                <p>Tu n’as rien à leur proposer</p>
                                                            @else
                                                                @foreach ($suggestion['iCanGive'] as $mySticker)
                                                                    <span
                                                                        class="badge badge-lg bg-red text-red-fg">{{ $mySticker->sticker->id }}</span>
                                                                    @php($iCanGive .= $mySticker->sticker->id . ', ')
                                                                @endforeach
                                                            @endif

                                                            <span class="iCanGive"
                                                                style="display:none;">{{ $iCanGive }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <span
                                                        class="firstname">{{ $suggestion['other_user']->firstname }}</span>
                                                    {{ $suggestion['other_user']->name }}
                                                </div>
                                                <div class="text-secondary">France</div>
                                            </td>
                                            <td>
                                                <div class="btn-list flex-nowrap">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#modal-contact" id="modal-button">
                                                        Contacter
                                                    </button>
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
        <div class="modal" id="modal-contact" tabindex="-1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Demande d'échange</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            {{-- <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Client name</label>
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Reporting period</label>
                                    <input type="date" class="form-control" />
                                </div>
                            </div> --}}
                            <div class="col-lg-12">
                                <div>
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" rows=15" id="modal-message"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Annuler </a>
                        <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            Envoyer
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#modal-button').on('click', function(event) {
                var message = 'Bonjour ';
                message += $(this).closest('tr').find('.firstname').text();
                message += ',\n\nJe suis intéressé par les stickers suivants : \n';
                message += $(this).closest('tr').find('.theyCanGive').text();
                message += '\n\nJe peux vous proposer : \n';
                message += $(this).closest('tr').find('.iCanGive').text();
                message +=
                    '\n\nN\'hésitez pas à me dire si un échange vous intéresse.\n\nBien cordialement,';
                message += '\n\n' + '{{ Auth::user()->firstname }}';
                $('#modal-message').val(message);
            });
        });
    </script>
@endsection
