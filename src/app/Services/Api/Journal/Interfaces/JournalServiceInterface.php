<?php

interface JournalServiceInterface
{
    public function getAllJournals();

    public function findJournalById($id);

    public function getCatalogWithJournals($id, $page);

    public function getCatalogs();
}
