<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClearanceMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {        
        if (Auth::user()->hasPermissionTo('Administrator')) {
            return $next($request);
        }

        //TYPECOA PERMISSION
        if ($request->is('type-coa/create')) {
            if (!Auth::user()->hasPermissionTo('Create_Type_Coa')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('type-coa/*/edit')) {
            if (!Auth::user()->hasPermissionTo('Edit_Type_Coa')) {
                abort('401');
            } else {
                return $next($request);
            }
        }
        //ENDOFTYPECOA

        //COA PERMISSION
        if ($request->is('coa/create')) {
            if (!Auth::user()->hasPermissionTo('Create_Coa')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('coa/*/edit')) {
            if (!Auth::user()->hasPermissionTo('Edit_Coa')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('coa/import')) {
            if (!Auth::user()->hasPermissionTo('Import_Coa')) {
                abort('401');
            } else {
                return $next($request);
            }
        }
        //ENDOFCOA

        //JOURNAL PERMISSION
        if ($request->is('journal/')) {
            if (!Auth::user()->hasPermissionTo('Create_Journal')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('journal/import')) {
            if (!Auth::user()->hasPermissionTo('Import_Journal')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('journal/posting')) {
            if (!Auth::user()->hasPermissionTo('Posting_Journal')) {
                abort('401');
            } else {
                return $next($request);
            }
        }
            
        if ($request->is('journal/*/edit')) {
            if (!Auth::user()->hasPermissionTo('Edit_Journal')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('journal/view/*')) {
            if (!Auth::user()->hasPermissionTo('Filter_Journal')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('journal/filter')) {
            if (!Auth::user()->hasPermissionTo('Filter_Journal')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        //NERACA LABARUGI
        if ($request->is('neraca')) {
            if (!Auth::user()->hasPermissionTo('View_Neraca')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('labarugi')) {
            if (!Auth::user()->hasPermissionTo('View_Labarugi')) {
                abort('401');
            } else {
                return $next($request);
            }
        }
        //ENDOFNERACALABARUGI

        if ($request->is('setup/*')) {
            if (!Auth::user()->hasPermissionTo('Setup_Settings')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        return $next($request);
    }
}