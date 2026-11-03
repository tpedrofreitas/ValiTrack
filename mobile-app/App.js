import React, { useEffect, useState } from 'react';
import {
  SafeAreaView,
  View,
  Text,
  StyleSheet,
  ActivityIndicator,
  ScrollView,
  TouchableOpacity,
} from 'react-native';
import api from './src/api/client';

export default function App() {
  const [categorias, setCategorias] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    (async () => {
      try {
        const res = await api.get('/categorias');
        setCategorias(res.data);
      } catch (e) {
        console.warn('Erro ao buscar categorias', e.message || e);
      } finally {
        setLoading(false);
      }
    })();
  }, []);

  const totalProdutos = categorias.length || 1;
  const dashboardCards = [
    {
      title: 'Produtos',
      value: totalProdutos,
      subtitle: 'ativos no catálogo',
      accent: '#dfeee8',
      icon: '↗',
      iconColor: '#0d7b68',
      tint: '#e3f3ed',
    },
    {
      title: 'Vencidos',
      value: 0,
      subtitle: 'lotes vencidos',
      accent: '#f7e3e7',
      icon: '↗',
      iconColor: '#d66a7a',
      tint: '#fbe7eb',
    },
    {
      title: 'Validade',
      value: '36 dias',
      subtitle: 'prazo mais próximo',
      accent: '#e4eefb',
      icon: '↗',
      iconColor: '#3d7adf',
      tint: '#ecf3ff',
    },
    {
      title: 'Alerta',
      value: 0,
      subtitle: 'abaixo do mínimo',
      accent: '#d6edea',
      icon: '+',
      iconColor: '#ffffff',
      tint: '#0e5d5d',
      isAction: true,
    },
  ];

  const navItems = [
    { label: 'Dashboard', icon: '▣', active: true },
    { label: 'Produtos', icon: '▤' },
    { label: 'Validade', icon: '▨' },
    { label: 'Estoque', icon: '☰' },
  ];

  if (loading) {
    return (
      <SafeAreaView style={styles.loadingWrap}>
        <ActivityIndicator size="large" color="#0c5b5b" />
      </SafeAreaView>
    );
  }

  return (
    <SafeAreaView style={styles.screen}>
      <ScrollView contentContainerStyle={styles.content} showsVerticalScrollIndicator={false}>
        <View style={styles.statusBar}>
          <Text style={styles.timeText}>12:42</Text>
          <View style={styles.statusIcons}>
            <View style={styles.signalDot} />
            <Text style={styles.signalText}>◔</Text>
            <Text style={styles.signalText}>▣</Text>
          </View>
        </View>

        <View style={styles.topBar}>
          <Text style={styles.brand}>ValiTrack</Text>
          <View style={styles.headerActions}>
            <Text style={styles.actionIcon}>◌</Text>
            <Text style={styles.actionIcon}>↗</Text>
          </View>
        </View>

        <View style={styles.heroCard}>
          <Text style={styles.greeting}>Olá, gestor</Text>
          <Text style={styles.heroTitle}>Controle de estoque em tempo real</Text>
          <Text style={styles.heroDescription}>
            Acompanhe validade, alertas e produtos em um único painel.
          </Text>

          <View style={styles.badgesRow}>
            <View style={styles.badgePill}>
              <Text style={styles.badgeText}>Estoque saudável</Text>
            </View>
            <View style={styles.badgePill}>
              <Text style={styles.badgeText}>1 lote(s) com saldo</Text>
            </View>
          </View>
        </View>

        <Text style={styles.sectionTitle}>Resumo operacional</Text>

        <View style={styles.summaryGrid}>
          {dashboardCards.map((card, index) => (
            <TouchableOpacity key={index} activeOpacity={0.9} style={styles.cardWrapper}>
              <View style={[styles.summaryCard, card.isAction && styles.summaryCardAction]}>
                <View style={[styles.iconWrap, { backgroundColor: card.accent }]}>
                  <Text style={[styles.cardIcon, { color: card.iconColor }]}>{card.icon}</Text>
                </View>

                <Text style={[styles.cardValue, card.isAction && styles.cardValueAction]}>{card.value}</Text>
                <Text style={[styles.cardLabel, card.isAction && styles.cardLabelAction]}>{card.title}</Text>
                <Text style={styles.cardSubLabel}>{card.subtitle}</Text>
              </View>
            </TouchableOpacity>
          ))}
        </View>

        <View style={styles.navBar}>
          {navItems.map((item) => (
            <TouchableOpacity key={item.label} style={styles.navItem} activeOpacity={0.8}>
              <View style={[styles.navIconWrap, item.active && styles.navIconWrapActive]}>
                <Text style={[styles.navIcon, item.active && styles.navIconActive]}>{item.icon}</Text>
              </View>
              <Text style={[styles.navLabel, item.active && styles.navLabelActive]}>{item.label}</Text>
            </TouchableOpacity>
          ))}
        </View>
      </ScrollView>
    </SafeAreaView>
  );
}

const styles = StyleSheet.create({
  screen: {
    flex: 1,
    backgroundColor: '#f3f3f3',
  },
  loadingWrap: {
    flex: 1,
    backgroundColor: '#f3f3f3',
    alignItems: 'center',
    justifyContent: 'center',
  },
  content: {
    paddingHorizontal: 20,
    paddingBottom: 20,
  },
  statusBar: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
    paddingTop: 10,
    paddingBottom: 8,
    marginBottom: 6,
  },
  timeText: {
    fontSize: 18,
    fontWeight: '600',
    color: '#111',
    letterSpacing: 0.5,
  },
  statusIcons: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 8,
  },
  signalDot: {
    width: 16,
    height: 16,
    borderRadius: 16,
    backgroundColor: '#111',
  },
  signalText: {
    fontSize: 18,
    color: '#111',
    fontWeight: '700',
  },
  topBar: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
    marginBottom: 20,
  },
  brand: {
    fontSize: 36,
    fontWeight: '700',
    color: '#1d1d1d',
    letterSpacing: -1,
  },
  headerActions: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 12,
  },
  actionIcon: {
    fontSize: 26,
    color: '#1d1d1d',
    fontWeight: '700',
  },
  heroCard: {
    borderRadius: 22,
    backgroundColor: '#0d5b5d',
    padding: 22,
    paddingBottom: 18,
    shadowColor: '#000',
    shadowOpacity: 0.08,
    shadowRadius: 10,
    shadowOffset: { width: 0, height: 8 },
    elevation: 5,
  },
  greeting: {
    color: '#ebf8f5',
    fontSize: 18,
    fontWeight: '700',
    marginBottom: 4,
  },
  heroTitle: {
    color: '#ffffff',
    fontSize: 30,
    fontWeight: '800',
    lineHeight: 34,
    marginBottom: 10,
  },
  heroDescription: {
    color: '#dcefe9',
    fontSize: 15,
    lineHeight: 22,
    marginBottom: 18,
  },
  badgesRow: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 10,
    flexWrap: 'wrap',
  },
  badgePill: {
    backgroundColor: 'rgba(255,255,255,0.18)',
    borderRadius: 12,
    paddingHorizontal: 12,
    paddingVertical: 8,
  },
  badgeText: {
    color: '#f4fffb',
    fontSize: 13,
    fontWeight: '600',
  },
  sectionTitle: {
    marginTop: 26,
    marginBottom: 16,
    fontSize: 30,
    fontWeight: '800',
    color: '#1b1b1b',
  },
  summaryGrid: {
    flexDirection: 'row',
    flexWrap: 'wrap',
    justifyContent: 'space-between',
    gap: 12,
  },
  cardWrapper: {
    width: '48%',
  },
  summaryCard: {
    backgroundColor: '#f3f5f4',
    borderRadius: 18,
    padding: 18,
    minHeight: 176,
    justifyContent: 'space-between',
    shadowColor: '#000',
    shadowOpacity: 0.04,
    shadowRadius: 6,
    shadowOffset: { width: 0, height: 4 },
    elevation: 2,
  },
  summaryCardAction: {
    backgroundColor: '#0d5b5d',
  },
  iconWrap: {
    width: 48,
    height: 48,
    borderRadius: 14,
    alignItems: 'center',
    justifyContent: 'center',
    marginBottom: 18,
  },
  cardIcon: {
    fontSize: 22,
    fontWeight: '800',
    lineHeight: 22,
  },
  cardValue: {
    fontSize: 28,
    fontWeight: '800',
    color: '#1d1d1d',
    marginBottom: 4,
  },
  cardValueAction: {
    color: '#ffffff',
  },
  cardLabel: {
    fontSize: 18,
    fontWeight: '700',
    color: '#232323',
  },
  cardLabelAction: {
    color: '#ffffff',
  },
  cardSubLabel: {
    color: '#666',
    fontSize: 12,
    lineHeight: 18,
    marginTop: 4,
  },
  navBar: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
    backgroundColor: '#f4f4f4',
    borderRadius: 18,
    paddingHorizontal: 12,
    paddingVertical: 10,
    marginTop: 22,
    shadowColor: '#000',
    shadowOpacity: 0.04,
    shadowRadius: 8,
    shadowOffset: { width: 0, height: 3 },
  },
  navItem: {
    alignItems: 'center',
    justifyContent: 'center',
    flex: 1,
  },
  navIconWrap: {
    width: 34,
    height: 34,
    borderRadius: 10,
    alignItems: 'center',
    justifyContent: 'center',
    marginBottom: 6,
  },
  navIconWrapActive: {
    backgroundColor: '#dfeee9',
  },
  navIcon: {
    fontSize: 20,
    color: '#2d2d2d',
    fontWeight: '700',
  },
  navIconActive: {
    color: '#0d5b5d',
  },
  navLabel: {
    fontSize: 11,
    color: '#555',
    fontWeight: '600',
  },
  navLabelActive: {
    color: '#0d5b5d',
  },
});
