@extends('layouts.teacher')

@section('content')
<section class="p-3">
    <header>
      <h3>Data Pertanyaan &raquo; Edit Data &raquo; <span class="text-primary">  {{ $pertanyaans->kode_pertanyaan }} </span></h3>
    </header>
  </section>

  <div class="row mt-4">
    <div class="col">
        <form action="{{ route('dashboard.pertanyaan.update', $pertanyaans->kode_pertanyaan) }}" method="post" enctype="multipart/form-data" >
            @method('put')
            @csrf

            <div class="flex-wrap mb-3 -mx-3">
                <div class="w-full px-3">
                <label for="category_id" class="px-1 mb-2" >Kategori</label>
                <select name="kode_kategori" id="kode_kategori" class="form-control @error('kode_kategori') is-invalid @enderror">
                    <option disabled selected>Pilih Kategori</option>
                        @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->kode_kategori }}" {{ old('kode_kategori') == $kategori->kode_kategori ? 'selected' : null }}>({{ $kategori->kode_kategori }})  {{ $kategori->nama_kategori }}</option>
                        @endforeach
                </select>
                @error('kode_kategori')
                <span class="invalid-feedback">{{ $message }}</span>  
                @enderror
                </div>
            </div>

            <div class="flex-wrap mb-4">
                <div class="w-full px-3 col-md-4">
                    <input name="kode_pertanyaan" id="kode_pertanyaan" type="text" value="{{ $pertanyaans->kode_pertanyaan}}" class="form-control @error('kode_pertanyaan') is-invalid @enderror">
                    @error('kode_pertanyaan')
                    <span class="invalid-feedback">{{ $message }}</span>  
                    @enderror
                </div>
            </div>

            <div class="form-floating w-full px-3">
                <textarea class="form-control @error('pertanyaan') is-invalid @enderror" name="pertanyaan" id="pertanyaan" style="height: 100px">{{ old('pertanyaan') }}</textarea>
                <label class="px-4" for="pertanyaan"> Pertanyaan</label>
                @error('pertanyaan')
                    <span class="invalid-feedback">{{ $message }}</span>  
                    @enderror
              </div>


    <!-- /.card-body -->
    <div class="flex-wrap mb-6 -mx-3">
        <div class="w-full px-3 mt-4">
            <button type="submit" class="hover:bg-gray-500 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" >
               Edit Data
            </button>
        </div>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
</form>
</div>
</div>

<script>
    document.getElementsByName('kode_kategori')[0].value = "{{ $pertanyaans->kode_kategori }}";
    </script>

@endsection