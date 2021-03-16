<?php

namespace App\Http\Controllers;

use App\Module;
use App\ModuleStep;
use App\ModuleBlock;
use App\Language;
use Illuminate\Http\Request;
use DB;


class AdminController extends Controller {
	public function getDefaultPage() {
		return view('admin.pages');
	}


    public function getModulePage($moduleAlias) {
		$module = Module :: where('alias', $moduleAlias) -> first();
		$moduleStep = ModuleStep :: where('top_level', $module -> id) -> orderBy('rang', 'desc') -> first();
		$moduleSteps = ModuleStep :: where('top_level', $module -> id) -> orderBy('rang', 'desc') -> get();

		$moduleStepData = DB :: table($moduleStep -> db_table) -> orderBy('id') -> get();

		return view('modules.core.step0', ['modules' => Module :: all(),
											'module' => $module,
											'moduleStep' => $moduleStep,
											'moduleSteps' => $moduleSteps,
											'moduleStepData' => $moduleStepData]);
	}


	public function addModulePage($moduleAlias) {
		$module = Module :: where('alias', $moduleAlias) -> first();
		$moduleStep = ModuleStep :: where('top_level', $module -> id) -> orderBy('rang', 'desc') -> first();

		DB :: table($moduleStep -> db_table) -> insert([
			'alias_ge' => 'temp'
		]);

		return redirect() -> route('moduleDataEdit', array($module -> alias, DB :: table($moduleStep -> db_table) -> max('id')));
	}


	public function editModulePage($moduleAlias, $id) {
		$module = Module :: where('alias', $moduleAlias) -> first();
		$moduleStep = ModuleStep :: where('top_level', $module -> id) -> orderBy('rang', 'desc') -> first();
		$moduleBlocks = ModuleBlock :: where('top_level', $moduleStep -> id) -> orderBy('rang', 'desc') -> get();
		$pageData = DB :: table($moduleStep -> db_table) -> find($id);


		// $prevId = 0;
		// $nextId = 0;

		// $prevIdIsSaved = false;
		// $nextIdIsSaved = false;

		// foreach(DB :: table($moduleStep -> db_table) -> orderBy('id') as $data) {
		// 	if($nextIdIsSaved && !$nextId) {
		// 		$nextId = $data -> id;
		// 	}
			
		// 	if($pageData -> id === $data -> id) {
		// 		$prevIdIsSaved = true;
		// 		$nextIdIsSaved = true;
		// 	}
			
		// 	if(!$prevIdIsSaved) {
		// 		$prevId = $data -> id;
		// 	}
		// }

		
		return view('modules.core.step1', ['modules' => Module :: all(),
											'module' => $module,
											'moduleStep' => $moduleStep,
											'moduleBlocks' => $moduleBlocks,
											'languages' => Language :: where('published', 1) -> get(),
											'data' => $pageData]);
	}


	public function updateModulePage(Request $request, $moduleAlias, $id) {
		$module = Module :: where('alias', $moduleAlias) -> first();
		$moduleStep = ModuleStep :: where('top_level', $module -> id) -> orderBy('rang', 'desc') -> first();
		$moduleBlocks = ModuleBlock :: where('top_level', $moduleStep -> id) -> orderBy('rang', 'desc') -> get();

		$updateQuery = [];

		foreach($moduleBlocks as $data) {
			if($data -> type !== 'published' && $data -> type !== 'rang') {
				$updateQuery[$data -> db_column] = (!is_null($request -> input($data -> db_column)) ? $request -> input($data -> db_column) : '');
			}
		}

		DB :: table($moduleStep -> db_table) -> where('id', $id) -> update($updateQuery);

		return redirect() -> route('moduleDataEdit', array($module -> alias, $id));
	}


	public function deleteModulePage($moduleAlias, $id) {
		$module = Module :: where('alias', $moduleAlias) -> first();
		$moduleStep = ModuleStep :: where('top_level', $module -> id) -> orderBy('rang', 'desc') -> first();

		DB :: table($moduleStep -> db_table) -> delete($id);

		return redirect() -> route('moduleGetData', $module -> alias);
	}
}
