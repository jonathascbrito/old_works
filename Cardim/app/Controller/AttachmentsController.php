<?php

/**
 * FilesController
 *
 * Define métodos de acesso ao sistema de arquivos, permitindo o upload e
 * download de arquivos.
 */
class AttachmentsController extends AppController
{
    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = '';
    public $bundle = 'Attachments';

    /**
     * Define os modelos utilizados por este controlador.
     * @var array
     */
    public $uses = array(
        'Attachment'
    );

    /**
     * Método responsável por receber e armazenar um novo arquivo no sistema.
     * @controller-action
     */
    public function upload() {
        $this->autoRender = false;

        if ($this->isMethod('post')) {
            if ($this->Attachment->save($this->request->data)) {
                echo $this->Attachment->id;
                return;
            }
        }

        echo '0';
    }

    /**
     * Método responsável por enviar um arquivo previamente armazenado no sistema.
     * @controller-action
     */
    public function download($id) {
        $this->autoRender = false;

	$file = $this->Attachment->find('first', array(
            'conditions' => array(
                'Attachment.id' => $id
            )
	));

	if ( ! $file) {
            throw new NotFoundException();
        }

        $this->response->disableCache();

        $this->response->type($file['Attachment']['mime']);
        $this->response->file($file['Attachment']['path'], array(
            'name' => $file['Attachment']['name'],
            'download' => true
        ));

        $this->response->send();
    }

}

?>