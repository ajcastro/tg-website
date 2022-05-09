<?php

namespace App\Http\Controllers\Traits;

use App\Http\UserLogAttributes\Contracts\CrudUserLogContract;
use App\Models\UserLog;
use Exception;
use Illuminate\Http\Request;

trait CrudUserLog
{
    protected CrudUserLogContract $crudUserLog;

    protected function setUpCrudUserLog()
    {
        $this->setUpIndexUserLog();
        $this->setUpShowUserLog();
        $this->setUpStoreUserLog();
        $this->setUpUpdateUserLog();
        $this->setUpSetActiveStatusUserLog();
    }

    protected function setUpIndexUserLog()
    {
        $this->hook(function (Request $request) {
            $this->makeUserLog($request)
                ->fill($this->crudUserLog->index($request))
                ->save();
        })->only(['index']);
    }

    protected function setUpShowUserLog()
    {
        $this->hook(function (Request $request) {
            $this->makeUserLog($request)
                ->fill($this->crudUserLog->show($request, $this->resolveRecord($request)))
                ->save();
        })->only(['show']);
    }

    protected function setUpStoreUserLog()
    {
        $this->hook(function (Request $request) {
            $this->makeUserLog($request)
                ->fill($this->crudUserLog->store($request))
                ->save();
        })->only(['store']);
    }

    protected function setUpUpdateUserLog()
    {
        $this->hook(function (Request $request) {
            $this->makeUserLog($request)
                ->fill($this->crudUserLog->update($request, $this->resolveRecord($request)))
                ->save();
        })->only(['update']);
    }

    protected function setUpSetActiveStatusUserLog()
    {
        $this->hook(function (Request $request) {
            if ($request->boolean('is_active')) {
                $this->makeUserLog($request)
                    ->fill($this->crudUserLog->activate($request, $this->resolveRecord($request)))
                    ->save();
            } else {
                $this->makeUserLog($request)
                    ->fill($this->crudUserLog->deactivate($request, $this->resolveRecord($request)))
                    ->save();
            }
        })->only(['setActiveStatus']);
    }

    protected function resolveRecord(Request $request)
    {
        throw new Exception('Missing method resolveRecord() in '.get_class($this));
    }

    protected function makeUserLog(Request $request): UserLog
    {
        return UserLog::fromRequest($request);
    }
}
