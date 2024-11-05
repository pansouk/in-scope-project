<?php

namespace App\Services;

use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Database\Eloquent\Collection;

class CompanyService
{
    protected CompanyRepository $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->companyRepository->index();
    }

    /**
     * @param array $data
     * @return Company
     */
    public function create(array $data): Company
    {
        return $this->companyRepository->create($data);
    }

    /**
     * @param string $uuid
     * @return Company
     */
    public function show(string $uuid): Company
    {
        return $this->companyRepository->show($uuid);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function update(array $data): bool
    {
        return $this->companyRepository->update($data);
    }

    /**
     * @param string $uuid
     * @return bool|null
     */
    public function delete(string $uuid): bool|null
    {
        return $this->companyRepository->delete($uuid);
    }

}
