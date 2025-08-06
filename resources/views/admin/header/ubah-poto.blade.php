<div id="profileModal" style="display:none;position:fixed;z-index:9999;left:0;top:0;width:100vw;height:100vh;background:rgba(0,0,0,0.3);align-items:center;justify-content:center;">
      <div style="background:#fff;padding:32px 24px 24px 24px;border-radius:10px;box-shadow:0 2px 16px rgba(0,0,0,0.15);min-width:320px;position:relative;">
        <span id="closeProfileModal" style="position:absolute;right:16px;top:10px;font-size:1.5em;cursor:pointer;">&times;</span>
        <h3 style="margin-bottom:18px;">Ubah Foto Profil Admin</h3>
        <form id="profileUploadForm" action="admin_upload_profile.php" method="POST" enctype="multipart/form-data">
          <input type="file" id="profileFileInput" name="profile_img" accept="image/*" required style="margin-bottom:16px;">
          <br>
          <div style="width:160px;height:160px;margin:0 auto 16px auto;display:flex;align-items:center;justify-content:center;">
            <img id="profilePreview" src="" alt="Preview" style="max-width:160px;max-height:160px;border-radius:50%;display:none;background:#f0f0f0;object-fit:cover;">
          </div>
          <button type="submit" id="uploadBtn" style="padding:8px 24px;background:#007bff;color:#fff;border:none;border-radius:5px;font-weight:600;">Upload</button>
        </form>
        <div id="profileUploadMsg" style="margin-top:10px;color:#28a745;font-weight:500;"></div>
      </div>
    </div>
    