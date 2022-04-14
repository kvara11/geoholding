<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\ModuleLevel;
use App\Models\ModuleStep;
use App\Models\ModuleBlock;
use App\Models\Page;
use App\Models\Bsc;
use App\Models\Bsw;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AModuleLevelUpdateRequest;
use Session;


class AModuleLevelController extends AController {
	public function add($moduleId) {
		$module = Module :: find($moduleId);

		$moduleLevel = new ModuleLevel();

		$moduleLevel -> top_level = $module -> id;

		$moduleLevel -> save();


		return redirect() -> route('moduleLevelEdit', array($module -> id, $moduleLevel -> id));
	}


	public function edit($moduleId, $id) {
		// ModuleBlock :: deleteEmpty();

		$moduleLevel = ModuleLevel :: find($id);


		$prevId = 0;
		$nextId = 0;

		$prevIdIsSaved = false;
		$nextIdIsSaved = false;

		// dd($moduleLevel -> module -> moduleLevel);

		foreach($moduleLevel -> module -> moduleLevel as $data) {
			if($nextIdIsSaved && !$nextId) {
				$nextId = $data -> id;
			}
			
			if($moduleLevel -> id === $data -> id) {
				$prevIdIsSaved = true;
				$nextIdIsSaved = true;
			}
			
			if(!$prevIdIsSaved) {
				$prevId = $data -> id;
			}
		}

		// dd(ModuleLevel :: find($prevId));

		$data = array_merge(self :: getDefaultData(), [
														'languages' => Language :: where('disable', 1) -> get(),
														'moduleLevel' => $moduleLevel,
														'prev' => $prevId,
														'next' => $nextId
													]);


		return view('modules.modules.admin_panel.edit_step_level', $data);
	}


	public function update(AModuleLevelUpdateRequest $request, $moduleId, $id) {
		$moduleLevel = ModuleLevel :: find($id);

		$moduleLevel -> title = $request -> input('title');

		$moduleLevel -> save();

		
		$request -> session() -> flash('successStatus', __('bsw.successStatus')); // Status for success.

		return redirect() -> route('moduleLevelEdit', array($moduleLevel -> module -> id, $moduleLevel -> id));
	}
	

	public function delete($moduleId, $id) {
		ModuleLevel :: destroy($id);

		Session :: flash('successDeleteStatus', __('bsw.deleteSuccessStatus'));

		return redirect() -> route('moduleEdit', $moduleId);
	}
}
