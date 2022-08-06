<div class="card-body">
    <div class="container">
        <div class="col-md-12">
            @error('letters')
                <span class="error">
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                </span>
            @enderror
            @error('number')
                <span class="error">
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                </span>
            @enderror
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Ingrese 12 caracteres" wire:model="letters">
                <input type="number" class="form-control" min="2" max="12" placeholder="Ingrese # de letras" wire:model="number">
                <button class="btn btn-outline-primary" type="button" wire:click="generate">Generar</button>
            </div>
        </div>
    </div>
    @if(!!$this->words)
        <div class="row">
            <div class="col-md-12">
                <p>
                    {{ $this->words }}
                </p>
            </div>
        </div>
    @endif
</div>
