<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index(): View
    {
        $files = File::all(); // Повертає колекцію моделей

        return view('file.index', compact('files'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // до 10 MB
        ]);

        $uploadedFile = $request->file('file');
        $originalName = $uploadedFile->getClientOriginalName();
        $path = $uploadedFile->store('uploads', 'public');

        File::create([
            'original_name' => $originalName,
            'path' => $path,
        ]);

        return back()->with('success', 'Файл завантажено.');
    }

    public function download($id)
    {
        $file = File::findOrFail($id);

        // Отримуємо шлях у storage/app/public/...
        $filePath = $file->path;

        // Віддаємо файл із заголовком оригінальної назви
        return Storage::disk('public')->download($filePath, $file->original_name);
    }

    public function destroy(File $file)
    {
        if (!$file) {
            return back()->with('error', 'Файл не знайдено в базі.');
        }

        // Перевіряємо, чи існує фізичний файл
        if (Storage::disk('public')->exists($file->path)) {
            Storage::disk('public')->delete($file->path);
        }

        // Видаляємо запис з бази
        $file->delete();

        return back()->with('success', 'Файл успішно видалено.');
    }


    // Вказуємо дату до якої виконати (дедлайн)
    public function updateDueDate(Request $request, File $file)
    {
        $request->validate([
            'due_date' => 'nullable|date',
        ]);

        $file->due_date = $request->due_date;
        $file->save();

        return back()->with('success', 'Дата виконання оновлена');
    }


    // Додавання галочки виконано
    public function updateDone(Request $request, File $file)
    {
        $file->is_done = $request->has('is_done');
        $file->save();

        return back();
    }

    public function fileTask(File $file): View
    {
        return view('file.task', compact('file'));
    }
}
