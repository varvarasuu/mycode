<?php

namespace App\Repositories\Api\CoverLetter;

use App\Models\CoverLetter;

class CoverLetterRepository implements CoverLetterRepositoryInterface
{
    public function create($data)
    {
        $cover_letter = CoverLetter::create([
            'title' => $data["title"],
            'content' => $data["content"],
            'account_id' => $data["account_id"],
        ]);

        return $cover_letter;
    }

    public function get($id)
    {
        $cover_letter = CoverLetter::find($id);
        return $cover_letter;
    }

    public function update($data)
    {
        $cover_letter = $this->get($data["id"]);
        $cover_letter->title = $data["title"];
        $cover_letter->content = $data["content"];
        $cover_letter->save();
        return $cover_letter;
    }

    public function getNotDeleted($account_id)
    {
        $cover_letters = CoverLetter::where('account_id', $account_id)
            ->where('deleted', 0)
            ->orderBy('updated_at', 'desc')
            ->get();

        return $cover_letters;
    }

    public function delete($id)
    {
        $cover_letter = $this->get($id);
        $cover_letter->deleted = 1;
        $cover_letter->save();
        return true;
    }
}
