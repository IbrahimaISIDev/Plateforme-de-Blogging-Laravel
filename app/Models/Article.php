<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'content',
        'excerpt',
        'is_published',
        'published_at'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime'
    ];

    /**
     * Relation : Un article appartient à une catégorie
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scope : Récupérer uniquement les articles publiés
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                    ->whereNotNull('published_at')
                    ->orderBy('published_at', 'desc');
    }

    /**
     * Scope : Récupérer uniquement les brouillons
     */
    public function scopeDraft($query)
    {
        return $query->where('is_published', false);
    }

    /**
     * Générer automatiquement le slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
            
            // Si on publie l'article, définir la date de publication
            if ($article->is_published && !$article->published_at) {
                $article->published_at = now();
            }
        });

        static::updating(function ($article) {
            $article->slug = Str::slug($article->title);
            
            // Si on publie l'article pour la première fois
            if ($article->is_published && !$article->getOriginal('is_published')) {
                $article->published_at = now();
            }
        });
    }

    /**
     * Accesseur : Obtenir un extrait généré automatiquement si non défini
     */
    public function getExcerptAttribute($value)
    {
        if (!empty($value)) {
            return $value;
        }
        
        return Str::limit(strip_tags($this->content), 150);
    }
}