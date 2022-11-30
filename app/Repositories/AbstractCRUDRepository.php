<?php

namespace App\Repositories;

use Illuminate\Http\Response;

class AbstractCRUDRepository
{
    protected $model;

    public function getModelById($id)
    {
        return $this->model->find($id);
    }

    public function index(): Response
    {
        try {
            $records = $this->model->all();
            return response(
                [
                    'data' => $records,
                    'message' => 'Records found successfully.'
                ],
                200
            );

//            return response(['data' => [], 'message' => 'Records not found.'], 404);
        } catch (\Exception $error) {
            return response(['message' => 'Something wrong happen. Try again.'], 500);
        }
    }

    public function create(array $data): Response
    {
        try {
            return response(
                [
                    'data' => $this->model->create($data),
                    'message' => 'Successfully created.'
                ],
                201
            );
        } catch (\Exception $error) {
            return response(['message' => 'Something wrong happen. Try again.'], 500);
        }
    }

    public function store(array $data): Response
    {
        try {
            return response(['data' => $this->model->create($data)], 200);
        } catch (\Exception $error) {
            return response(['message' => 'Something wrong happen. Try again.'], 500);
        }
    }

    public function update(array $data, $id): Response
    {
        try {
            $record = $this->model->find($id);

            if ($record && $record->id) {
                foreach ($data as $indice => $field) {
                    if (in_array($indice, $this->model->fillable)) {
                        $record->$indice = $data[$indice];
                    }
                }
                $record->update();

                return response(['data' => $record, 'message' => 'Successfully updated'], 200);
            }

            return response(['data' => '', 'message' => 'Record not found.'], 200);
        } catch (\Exception $error) {
            return response(['message' => 'Something wrong happen. Try again.'], 500);
        }
    }

    public function show($id): Response
    {
        try {
            $data = $this->model->find($id);
            if ($data && $data->id) {
                return response(['data' => $data], 200);
            }

            return response(['data' => '', 'message' => 'Record not found.'], 404);
        } catch (\Exception $error) {
            return response(['message' => 'Something wrong happen. Try again.'], 500);
        }
    }

    public function destroy($id): Response
    {
        try {
            $responseData = $this->show($id);

            if ($responseData->getStatusCode() == 200) {
                $data = $this->model->find($id);
                $data->delete();
                return response(['data' => $data, 'message' => 'Successfully deleted'], 200);
            }

            return $responseData;
        } catch (\Exception $error) {
            return response(['message' => 'Something wrong happen. Try again.'], 500);
        }
    }
}
