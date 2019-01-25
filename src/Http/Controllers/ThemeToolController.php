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
    protected $paletteModel;

    public function __construct()
    {
        $themeClass = config('temply.model_theme');
        $paletteClass = config('temply.model_palette');

        $this->themeModel = new $themeClass();
        $this->paletteModel = new $paletteClass();
    }

    public function getThemes()
    {
        return response()->json([
            'themes' => $this->themeModel->availables(),
            'active' => [
                'theme'   => auth()->user()->currentTheme,
                'palette' => auth()->user()->currentPalette,
            ],
        ]);
    }

    /**
     * @param Request $request
     */
    public function setTheme(Request $request)
    {
        $theme = $this->themeModel->find($request->theme);
        $palette = $this->paletteModel->find($request->palette);

        event(new ThemeActivated($theme, $palette));

        return response()->json([
            'success' => true,
        ]);
    }
}
