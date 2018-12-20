<?php

namespace Infinety\TemplyThemeManager\Http;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Infinety\TemplyThemeManager\Events\ThemeActivated;

class ThemeToolController extends Controller
{
    /**
     * @var mixed
     */
    protected $themeModel;

    /**
     * @var mixed
     */
    protected $palleteModel;

    public function __construct()
    {
        $themeClass = config('temply.model_theme');
        $palleteClass = config('temply.model_pallete');

        $this->themeModel = new $themeClass();
        $this->palleteModel = new $palleteClass();
    }

    public function getThemes()
    {
        return response()->json([
            'themes' => $this->themeModel->availables(),
            'active' => [
                'theme'   => auth()->user()->currentTheme,
                'pallete' => auth()->user()->currentPallete,
            ],
        ]);
    }

    /**
     * @param Request $request
     */
    public function setTheme(Request $request)
    {
        $theme = $this->themeModel->find($request->theme);
        $pallete = $this->palleteModel->find($request->pallete);

        event(new ThemeActivated($theme, $pallete));

        return response()->json([
            'success' => true,
        ]);
    }
}
