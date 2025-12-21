<div id="view-user-modal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="view-user-title">Detail Pengguna</h2>
            <span class="close-button">&times;</span>
        </div>
        <div class="modal-body">
            <div class="user-details-grid">
                <div class="detail-item">
                    <label>Nama Lengkap</label>
                    <span id="view-user-name"></span>
                </div>
                <div class="detail-item">
                    <label>Email</label>
                    <span id="view-user-email"></span>
                </div>
                <div class="detail-item">
                    <label>Nomor Telepon</label>
                    <span id="view-user-telepon"></span>
                </div>
                <div class="detail-item">
                    <label>Alamat</label>
                    <span id="view-user-alamat"></span>
                </div>
                <div class="detail-item detail-item-full">
                    <label>Dokumen</label>
                    <div class="user-document-images">
                    <div>
                        <p>Foto KTP</p>
                        {{-- Tambahkan class 'lightbox-trigger' di sini --}}
                        <img id="view-user-ktp" src="" alt="Foto KTP" class="lightbox-trigger">
                    </div>
                    <div>
                        <p>Foto SIM A</p>
                        {{-- Tambahkan class 'lightbox-trigger' di sini --}}
                        <img id="view-user-kk" src="" alt="Foto KK" class="lightbox-trigger">
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>