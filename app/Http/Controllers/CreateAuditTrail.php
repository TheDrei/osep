<?php
namespace App\Http;

use App\Models\CreateAuditTrailModel;
use Illuminate\Http\Request;
use DB;

trait CreateAuditTrail {
    public function create_audit_trail(String $action, Request $request) {
        DB::table('audit_trail')->insert(
          [
            'user_id' => $request->user()->id,
            'action' => $action,
            'module_id' => $module_id,
            'audit_item' => $audit_item,
            'before_action' => $before_action,
            'after_action' => $after_action,
            'datetime' => DB::raw('now()'),
            'ip_address' => $request->ip(),
            'host_name' => $request->getHttpHost()
          ]
        );
    }
}
