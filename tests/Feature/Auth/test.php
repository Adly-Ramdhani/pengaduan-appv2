migratios complain
$table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->id('provinces_id');
            $table->id('regencis_id');
            $table->id('districts_id');
            $table->id('villages_id');
            $table->enum('name', ['kejahatan', 'pembangunan', 'sosial']);
            $table->enum('status', ['pending', 'proses', 'selesai', 'tolak'])->default('pending'); 
            $table->text('detail');
            $table->string('image_path')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->integer('total_likes')->default(0);
            $table->integer('total_views')->default(0);
            $table->timestamps();
    
            $table->foreign('provinces_id')->references('id')->on('provinces')->onDelete('cascade');
            $table->foreign('regencis_id')->references('id')->on('regencis')->onDelete('cascade');
            $table->foreign('districts_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('villages_id')->references('id')->on('villages')->onDelete('cascade');

contelor complain
public function index()
    {
        // $complaint = Complaint::get();
        $complaint = Complaint::with(['provinces', 'village', 'regencie'])->get();
        return view('complaint.index', compact('complaint'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = Province::all(); 
        $regencies = Regencis::all();
        $districts = Districts::all(); 
        $villages = Village::all();

        return view('complaint.store', compact('provinces','districts','regencies','villages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Log::info('Request masuk:', $request->all());
    
            // Validasi request
            $request->validate([
                'provinces_id' => 'required',
                'regencis_id' => 'required',
                'districts_id' => 'required',
                'villages_id' => 'required',
                'name' => 'required|string|max:255',
                'detail' => 'required|string',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120'
            ]);
    
            $data = Complaint::create([
                'user_id' => auth()->id(), // Pastikan user sedang login
                'provinces_id' => $request->provinces_id,
                'regencis_id' => $request->regencis_id,
                'districts_id' => $request->districts_id,
                'villages_id' => $request->villages_id,
                'name' => $request->name,
                'detail' => $request->detail,
                'is_verified' => $request->has('is_verified'),
            ]);
    
            Log::info('Data tersimpan:', $data->toArray());
    
            // Simpan gambar jika ada
            if ($request->hasFile('image_path')) {
                $file = $request->file('image_path');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = 'complain-img/' . $fileName;
                
                $file->move(public_path('complain-img'), $fileName);
                $data->update(['image_path' => $filePath]);
            }
    
            return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dikirim!');
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $complaint = Complaint::with(['provinces', 'village', 'regencie'])->findOrFail($id);
            return view('complaint.show', compact('complaint'));
        } catch (\Exception $e) {
            \Log::error('Gagal menampilkan detail pengaduan: ' . $e->getMessage());
            return redirect()->route('pengaduan.index')->with('error', 'Terjadi kesalahan saat menampilkan pengaduan.');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required',
            ]);

            $complaint = Complaint::findOrFail($id);
            $complaint->status = $request->status;
            $complaint->save();

            return redirect()->route('complaints.show', $complaint->id)->with('success', 'Pengaduan berhasil!');
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function done(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required',
            ]);

            $complaint = Complaint::findOrFail($id);
            $complaint->status = $request->status;
            $complaint->save();

            return redirect()->route('complaints.show', $complaint->id)->with('success', 'Pengaduan Selesai!');
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

model complaint
lass Complaint extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

    protected static function booted() {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
    
    public function provinces()
    {
        return $this->belongsTo(Province::class, 'provinces_id');
    }

    public function regencie()
    {
        return $this->belongsTo(Regencis::class, 'regencis_id');
    }

    public function district()
    {
        return $this->belongsTo(Districts::class, 'districts_id');
    }


    public function village()
    {
        return $this->belongsTo(Village::class, 'villages_id', 'id');
    }

     // public function likes()
    // {
    //     return $this->hasMany(ComplaintLike::class, 'complaint_id');
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); 
    }

    // public function progresses()
    // {
    //     return $this->hasMany(ComplaintProgress::class);
    // }


    controller 
    Route::middleware(['auth', 'checkRole:admin'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('admin', AdminController::class);
});

Route::middleware(['auth', 'checkRole:user'])->group(function () {
    Route::post('/complaint/{id}/like', [ComplaintLikeController::class, 'toggleLike']);
    Route::resource('users', UserController::class);
    // Route::resource('pengaduan', ComplaintController::class);
    Route::get('pengaduan', [ComplaintController::class, 'index'])->name('pengaduan.index');
    Route::get('pengaduan/create', [ComplaintController::class, 'create'])->name('pengaduan.create');
    Route::post('pengaduan/store', [ComplaintController::class, 'store'])->name('pengaduan.store');
    Route::get('pengaduan/show/{id}', [ComplaintController::class, 'show'])->name('complaint.show');
    Route::post('/comments{complaint}', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{id}', [CommentController::class, 'show'])->name('comments.show');
    Route::get('/get-regencies', [RegencisController::class, 'index']);
    Route::get('/get-districts', [DistrictsController::class, 'index']);
    Route::get('/get-villages', [VillageController::class, 'index']);
});

Route::middleware(['auth', 'checkRole:petugas'])->group(function () {
    Route::put('/complaints/update-status/{id}', [ComplaintController::class, 'updateStatus'])->name('complaints.updateStatus');
    Route::get('/complaints/{id}', [StaffController::class, 'show'])->name('complaints.show');
    Route::post('/complaints/progress', [ComplaintProgressController::class, 'store'])->name('complaints.progress.store');
    Route::post('/complaints/staff/{id}', [ComplaintController::class, 'done'])->name('complaints.done');
    Route::get('staff', [StaffController::class, 'index'])->name('pengaduan.staff.index');
});


