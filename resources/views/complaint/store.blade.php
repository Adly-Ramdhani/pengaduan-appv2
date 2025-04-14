@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Form Keluhan</h4>
        </div>
        <div class="card-body">
            <form id="pengaduanForm" action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="provinces_id" class="form-label">Provinsi</label>
                    <select class="form-select" id="provinces_id" name="provinces_id">
                        <option value="">Pilih Provinsi</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Provinsi wajib dipilih.</div>
                </div>

                <div class="mb-3">
                    <label for="regencis_id" class="form-label">Kota/Kabupaten</label>
                    <select class="form-select" id="regencis_id" name="regencis_id" disabled>
                        <option value="">Pilih Kota/Kabupaten</option>
                    </select>
                    <div class="invalid-feedback">Kota/Kabupaten wajib dipilih.</div>
                </div>

                <div class="mb-3">
                    <label for="districts_id" class="form-label">Kecamatan</label>
                    <select class="form-select" id="districts_id" name="districts_id" disabled>
                        <option value="">Pilih Kecamatan</option>
                    </select>
                    <div class="invalid-feedback">Kecamatan wajib dipilih.</div>
                </div>

                <div class="mb-3">
                    <label for="villages_id" class="form-label">Kelurahan</label>
                    <select class="form-select" id="villages_id" name="villages_id" disabled>
                        <option value="">Pilih Kelurahan</option>
                    </select>
                    <div class="invalid-feedback">Kelurahan wajib dipilih.</div>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Tipe Keluhan</label>
                    <select class="form-select" id="name" name="name">
                        <option value="">Pilih Tipe Keluhan</option>
                        <option value="kejahatan">Kejahatan</option>
                        <option value="pembangunan">Pembangunan</option>
                        <option value="sosial">Sosial</option>
                    </select>
                    <div class="invalid-feedback">Tipe keluhan wajib dipilih.</div>
                </div>

                <div class="mb-3">
                    <label for="detail" class="form-label">Detail Keluhan</label>
                    <textarea class="form-control" id="detail" name="detail" rows="3"></textarea>
                    <div class="invalid-feedback">Detail keluhan wajib diisi.</div>
                </div>

                <div class="mb-3">
                    <label for="image_path" class="form-label">Gambar Pendukung</label>
                    <input type="file" class="form-control" id="image_path" name="image_path">
                    <div class="invalid-feedback">Gambar wajib diunggah.</div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="is_verified" name="is_verified">
                    <label class="form-check-label" for="is_verified">Laporan yang disampaikan sesuai dengan kebenaran</label>
                </div>

                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        function resetSelect(selectElement, placeholder) {
            selectElement.html(`<option value="">${placeholder}</option>`);
            selectElement.prop("disabled", true);
        }

        function loadOptions(url, data, targetSelect, placeholder) {
            resetSelect(targetSelect, placeholder);
            $.ajax({
                url: url,
                type: "GET",
                data: data,
                success: function (response) {
                    if (response.length > 0) {
                        $.each(response, function (key, value) {
                            targetSelect.append(`<option value="${value.id}">${value.name}</option>`);
                        });
                        targetSelect.prop("disabled", false);
                    }
                }
            });
        }

        $("#provinces_id").change(function () {
            let provinceId = $(this).val();
            resetSelect($("#regencis_id"), "Pilih Kota/Kabupaten");
            resetSelect($("#districts_id"), "Pilih Kecamatan");
            resetSelect($("#villages_id"), "Pilih Kelurahan");

            if (provinceId) {
                loadOptions("/get-regencies", { provinces_id: provinceId }, $("#regencis_id"), "Pilih Kota/Kabupaten");
            }
        });

        $("#regencis_id").change(function () {
            let regencisId = $(this).val();
            resetSelect($("#districts_id"), "Pilih Kecamatan");
            resetSelect($("#villages_id"), "Pilih Kelurahan");

            if (regencisId) {
                loadOptions("/get-districts", { regencis_id: regencisId}, $("#districts_id"), "Pilih Kecamatan");
            }
        });

        $("#districts_id").change(function () {
            let districtId = $(this).val();
            resetSelect($("#villages_id"), "Pilih Kelurahan");

            if (districtId) {
                loadOptions("/get-villages", { districts_id: districtId }, $("#villages_id"), "Pilih Kelurahan");
            }
        });

        $("#pengaduanForm").submit(function (event) {
            let regencisId= $("#regencis_id").val();
            $("<input>").attr({
                type: "hidden",
                name: "regencis_id",
                value: regencisId
            }).appendTo("#pengaduanForm");
            $("#regencis_id").remove();
        });
    });
</script>
@endsection
