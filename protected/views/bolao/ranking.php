<?php
$this->renderPartial('_headerBolao',['bolao'=>$bolao]);
$posicoes = $bolao->posicoes;
$algumPendente = false;
?>
<?php if(count($posicoes)>0):?>
  <table class="uk-table uk-table-condensed uk-table-striped">
    <tr>
      <th>#</th>
      <th></th>
      <th class="uk-text-right uk-hidden-small" data-uk-tooltip title="Quantidade de acertos no placar exato da partida">
        <span class="uk-hidden-small">Placar exato</span>
        <span class="uk-visible-small"><i class="uk-icon uk-icon-info-circle"></i></span>
      </th>
      <th class="uk-text-right uk-hidden-small" data-uk-tooltip title="Quantidade de acertos de qual o time vencedor da partida <small>(Sem considerar acertos exatos de placar)</small>.">
        <span class="uk-hidden-small">Vencedor do jogo</span>
        <span class="uk-visible-small"><i class="uk-icon uk-icon-info-circle"></i></span>
      </th>
      <th class="uk-text-right" style="width:100px;">Pontos</th>
    </tr>
    <?php $count = 0; ?>
    <?php foreach ($posicoes as $p): ?>
      <?php $count++; ?>
      <?php
      $pendente =  $bolao->isInscricaoPendente($p->user->id);
      $algumPendente = $pendente || $algumPendente;
      $userLogado = $p->user->id == $this->user->id;
      $class = '';
      if($pendente) $class = 'pendente';
      else if($userLogado) $class = 'logado';
      ?>
      <tr class="<?=$class?>">
        <td><?=$count?>º</td>
        <td>
          <?=CHtml::encode(ucfirst($p->user->nome));?>
        </td>
        <td class="uk-text-right uk-hidden-small"><?=$p->qtdExatos?></td>
        <td class="uk-text-right uk-hidden-small"><?=$p->qtdVencedores?></td>
        <td class="uk-text-right"><b><?=$p->pontos?></b>
          <small class="uk-visible-small">
            <br>Exato: <?=$p->qtdExatos?>
            <br>Vencedor: <?=$p->qtdVencedores?>
          </small>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
  <?php if($algumPendente):?>
    <span class="uk-badge pendente uk-margin uk-text-danger">Legenda: Inscrição não confirmada.</span>
  <?php endif;?>
<?php else: ?>
  <br>
  <div class="uk-alert">
    Nenhum resultado.
  </div>
<?php endif; ?>
