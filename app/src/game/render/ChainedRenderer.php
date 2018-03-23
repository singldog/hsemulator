<?php

namespace app\game\render;

abstract class ChainedRenderer implements IRenderer{
    private $nextRenderer;

    public function next(){
        return $this->nextRenderer;
    }

    public function appendRender($nextRenderer){
        $this->nextRenderer = $nextRenderer;
    }

    public function render($data){
        if($this->nextRenderer){
            return $this->nextRenderer->render($this->selfRender($data));
        }else{
            return $this->renderData($data);
        }
    }

    public abstract function renderData($data);

}
