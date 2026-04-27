<?php

namespace Cp\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFile extends Model
{
    use HasFactory;


    const SUPPORTED_IMAGE_TYPES =  ['jpg', 'png', 'svg', 'bmp', 'jpeg', 'pjpeg', 'gif', 'webp', 'ico'];

    const SUPPORTED_WORD_TYPES  =  ['docx', 'doc', 'ppt', 'pptx', 'xlsx', 'csv'];

    const SUPPORTED_PDF_TYPES   =  ['pdf'];

    public function extension(): string
    {
        $ext = strtolower(trim((string) ($this->file_ext ?? ''), '.'));

        return $ext;
    }

    public function publicUrl(): string
    {
        return asset('storage/product_files/' . $this->file_name);
    }

    public function displayName(): string
    {
        return $this->file_original_name ?: $this->file_name ?: 'Download';
    }

    public function isPdf(): bool
    {
        return in_array($this->extension(), self::SUPPORTED_PDF_TYPES, true);
    }

    public function isImage(): bool
    {
        return in_array($this->extension(), self::SUPPORTED_IMAGE_TYPES, true);
    }

    /** PDF or image: can show embed / preview below list */
    public function canEmbedPreview(): bool
    {
        return $this->isPdf() || $this->isImage();
    }

    public function previewKind(): string
    {
        if ($this->isPdf()) {
            return 'pdf';
        }
        if ($this->isImage()) {
            return 'image';
        }

        return 'none';
    }
}
